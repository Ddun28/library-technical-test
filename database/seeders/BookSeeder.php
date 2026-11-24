<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Each entry is: [title, author, published_year, category, description].
     *
     * @var list<array{0: string, 1: string, 2: int, 3: string, 4: string}>
     */
    private const BOOKS = [
        ['Cien años de soledad', 'Gabriel García Márquez', 1967, 'Novela', 'La saga de la familia Buendía en el mítico pueblo de Macondo.'],
        ['Don Quijote de la Mancha', 'Miguel de Cervantes', 1605, 'Novela', 'Las aventuras del ingenioso hidalgo y su fiel escudero Sancho Panza.'],
        ['La sombra del viento', 'Carlos Ruiz Zafón', 2001, 'Novela', 'Un misterio literario ambientado en la Barcelona de posguerra.'],
        ['Dune', 'Frank Herbert', 1965, 'Ciencia ficción', 'La lucha por el control del planeta desértico Arrakis y de la especia melange.'],
        ['Fundación', 'Isaac Asimov', 1951, 'Ciencia ficción', 'La caída del Imperio Galáctico y el plan de Hari Seldon para acortar la barbarie.'],
        ['Neuromante', 'William Gibson', 1984, 'Ciencia ficción', 'La novela que definió el ciberpunk y el concepto de ciberespacio.'],
        ['Sapiens: De animales a dioses', 'Yuval Noah Harari', 2011, 'Historia', 'Una breve historia de la humanidad, desde el Paleolítico hasta la actualidad.'],
        ['Armas, gérmenes y acero', 'Jared Diamond', 1997, 'Historia', 'Por qué unas sociedades prosperaron y otras no a lo largo de la historia.'],
        ['La rebelión de las masas', 'José Ortega y Gasset', 1930, 'Ensayo', 'Un análisis filosófico sobre la sociedad de masas y la cultura europea.'],
        ['El mundo de Sofía', 'Jostein Gaarder', 1991, 'Ensayo', 'Una novela didáctica que recorre la historia de la filosofía occidental.'],
        ['Clean Code', 'Robert C. Martin', 2008, 'Tecnología', 'Principios y prácticas para escribir código legible y mantenible.'],
        ['El programador pragmático', 'Andrew Hunt y David Thomas', 1999, 'Tecnología', 'Consejos prácticos para convertirse en un desarrollador más eficaz.'],
        ['Refactoring', 'Martin Fowler', 1999, 'Tecnología', 'Técnicas para mejorar el diseño de código existente sin cambiar su comportamiento.'],
        ['Veinte poemas de amor y una canción desesperada', 'Pablo Neruda', 1924, 'Poesía', 'Uno de los poemarios más leídos de la literatura hispanoamericana.'],
    ];

    public function run(): void
    {
        $categories = Category::query()->pluck('id', 'name');

        foreach (self::BOOKS as [$title, $author, $year, $category, $description]) {
            Book::query()->updateOrCreate(
                ['title' => $title, 'author' => $author],
                [
                    'description' => $description,
                    'published_year' => $year,
                    'category_id' => $categories[$category],
                ],
            );
        }
    }
}
