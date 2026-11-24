<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_categories_with_their_books_count(): void
    {
        $category = Category::factory()->create(['name' => 'Novela']);
        Book::factory()->count(2)->for($category)->create();

        $this->getJson('/categories')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Novela')
            ->assertJsonPath('data.0.books_count', 2);
    }

    public function test_it_creates_a_category(): void
    {
        $this->postJson('/categories', ['name' => '  Ensayo  '])
            ->assertCreated()
            ->assertJsonPath('data.name', 'Ensayo');

        $this->assertDatabaseHas('categories', ['name' => 'Ensayo']);
    }

    public function test_the_category_name_is_required(): void
    {
        $this->postJson('/categories', ['name' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function test_the_category_name_must_be_unique(): void
    {
        Category::factory()->create(['name' => 'Poesía']);

        $this->postJson('/categories', ['name' => 'Poesía'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function test_it_updates_a_category_keeping_its_own_name(): void
    {
        $category = Category::factory()->create(['name' => 'Historia']);

        $this->putJson("/categories/{$category->id}", ['name' => 'Historia'])
            ->assertOk()
            ->assertJsonPath('data.name', 'Historia');
    }

    public function test_it_rejects_a_duplicated_name_when_updating(): void
    {
        Category::factory()->create(['name' => 'Historia']);
        $category = Category::factory()->create(['name' => 'Novela']);

        $this->putJson("/categories/{$category->id}", ['name' => 'Historia'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function test_it_deletes_a_category_without_books(): void
    {
        $category = Category::factory()->create();

        $this->deleteJson("/categories/{$category->id}")->assertNoContent();

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_it_does_not_delete_a_category_with_associated_books(): void
    {
        $category = Category::factory()->create();
        Book::factory()->count(2)->for($category)->create();

        $this->deleteJson("/categories/{$category->id}")
            ->assertConflict()
            ->assertJsonPath('code', 'CATEGORY_HAS_BOOKS')
            ->assertJsonPath('books_count', 2);

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_it_returns_not_found_when_deleting_a_missing_category(): void
    {
        $this->deleteJson('/categories/999999')->assertNotFound();
    }
}
