<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'published_year',
        'category_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_year' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Filter the query by category when a category id is provided.
     *
     * @param  Builder<Book>  $query
     * @return Builder<Book>
     */
    public function scopeFilterByCategory(Builder $query, ?int $categoryId): Builder
    {
        return $query->when(
            $categoryId !== null,
            fn (Builder $query) => $query->where('category_id', $categoryId),
        );
    }
}
