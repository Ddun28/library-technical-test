<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * @var list<string>
     */
    private const CATEGORIES = [
        'Novela',
        'Ciencia ficción',
        'Historia',
        'Tecnología',
        'Poesía',
        'Ensayo',
    ];

    public function run(): void
    {
        foreach (self::CATEGORIES as $name) {
            Category::query()->firstOrCreate(['name' => $name]);
        }
    }
}
