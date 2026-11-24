<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_every_book_with_its_category(): void
    {
        Book::factory()->count(3)->create();

        $this->getJson('/books')
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'author',
                        'description',
                        'published_year',
                        'category_id',
                        'category' => ['id', 'name'],
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function test_it_filters_books_by_category(): void
    {
        $novela = Category::factory()->create(['name' => 'Novela']);
        $historia = Category::factory()->create(['name' => 'Historia']);

        Book::factory()->count(2)->for($novela)->create();
        Book::factory()->for($historia)->create();

        $this->getJson("/books?category={$novela->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.0.category_id', $novela->id)
            ->assertJsonPath('data.0.category.name', 'Novela');
    }

    public function test_it_returns_an_empty_list_when_the_category_has_no_books(): void
    {
        $category = Category::factory()->create();

        $this->getJson("/books?category={$category->id}")
            ->assertOk()
            ->assertJsonCount(0, 'data');
    }

    public function test_it_rejects_an_unknown_category_filter(): void
    {
        $this->getJson('/books?category=999999')
            ->assertUnprocessable()
            ->assertJsonValidationErrors('category');
    }

    public function test_it_creates_a_book(): void
    {
        $category = Category::factory()->create();

        $response = $this->postJson('/books', [
            'title' => 'Cien años de soledad',
            'author' => 'Gabriel García Márquez',
            'description' => 'La saga de la familia Buendía.',
            'published_year' => 1967,
            'category_id' => $category->id,
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.title', 'Cien años de soledad')
            ->assertJsonPath('data.category.id', $category->id);

        $this->assertDatabaseHas('books', [
            'title' => 'Cien años de soledad',
            'author' => 'Gabriel García Márquez',
            'published_year' => 1967,
            'category_id' => $category->id,
        ]);
    }

    public function test_it_requires_the_mandatory_fields_to_create_a_book(): void
    {
        $this->postJson('/books', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title', 'author', 'published_year', 'category_id']);
    }

    public function test_it_requires_a_title_with_at_least_three_characters(): void
    {
        $category = Category::factory()->create();

        $this->postJson('/books', [
            'title' => 'ab',
            'author' => 'Autor',
            'published_year' => 2000,
            'category_id' => $category->id,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('title');
    }

    public function test_it_rejects_invalid_published_years(): void
    {
        $category = Category::factory()->create();

        $base = [
            'title' => 'Libro válido',
            'author' => 'Autor',
            'category_id' => $category->id,
        ];

        $this->postJson('/books', $base + ['published_year' => 999])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('published_year');

        $this->postJson('/books', $base + ['published_year' => now()->year + 1])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('published_year');
    }

    public function test_it_rejects_a_category_that_does_not_exist(): void
    {
        $this->postJson('/books', [
            'title' => 'Libro huérfano',
            'author' => 'Autor',
            'published_year' => 2000,
            'category_id' => 999999,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('category_id');
    }

    public function test_it_updates_a_book(): void
    {
        $book = Book::factory()->create();
        $newCategory = Category::factory()->create();

        $this->putJson("/books/{$book->id}", [
            'title' => 'Título actualizado',
            'author' => 'Autor actualizado',
            'description' => 'Nueva descripción.',
            'published_year' => 2020,
            'category_id' => $newCategory->id,
        ])
            ->assertOk()
            ->assertJsonPath('data.title', 'Título actualizado')
            ->assertJsonPath('data.category_id', $newCategory->id);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Título actualizado',
            'author' => 'Autor actualizado',
            'published_year' => 2020,
            'category_id' => $newCategory->id,
        ]);
    }

    public function test_it_validates_the_book_when_updating(): void
    {
        $book = Book::factory()->create();

        $this->putJson("/books/{$book->id}", ['title' => 'x'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title', 'author', 'published_year', 'category_id']);
    }

    public function test_it_returns_not_found_when_updating_a_missing_book(): void
    {
        $this->putJson('/books/999999', [
            'title' => 'No existe',
            'author' => 'Autor',
            'published_year' => 2000,
            'category_id' => Category::factory()->create()->id,
        ])->assertNotFound();
    }

    public function test_it_deletes_a_book(): void
    {
        $book = Book::factory()->create();

        $this->deleteJson("/books/{$book->id}")->assertNoContent();

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_it_returns_not_found_when_deleting_a_missing_book(): void
    {
        $this->deleteJson('/books/999999')->assertNotFound();
    }
}
