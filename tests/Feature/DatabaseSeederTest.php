<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_is_idempotent(): void
    {
        $this->seed();
        $this->seed();

        $this->assertDatabaseCount('categories', 6);
        $this->assertDatabaseCount('books', 14);
    }

    public function test_seeded_books_are_related_to_seeded_categories(): void
    {
        $this->seed();

        $this->assertSame(0, Book::query()->whereDoesntHave('category')->count());
        $this->assertSame(6, Category::query()->has('books')->count());
    }

    public function test_eloquent_relationships_work_in_both_directions(): void
    {
        $category = Category::factory()->create();
        $book = Book::factory()->for($category)->create();

        $this->assertTrue($book->category->is($category));
        $this->assertTrue($category->books->contains($book));
    }
}
