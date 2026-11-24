<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::title(fake()->unique()->words(4, true)),
            'author' => fake()->name(),
            'description' => fake()->optional()->paragraph(),
            'published_year' => fake()->numberBetween(1900, (int) date('Y')),
            'category_id' => Category::factory(),
        ];
    }
}
