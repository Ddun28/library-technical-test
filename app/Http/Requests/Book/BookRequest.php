<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

abstract class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'published_year' => ['required', 'integer', 'between:1000,'.now()->year],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            collect($this->only(['title', 'author', 'description']))
                ->map(fn (mixed $value) => is_string($value) ? trim($value) : $value)
                ->filter(fn (mixed $value, string $key) => $key !== 'description' || $value !== '')
                ->all(),
        );
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'published_year.between' => 'El año de publicación debe ser un año válido (entre 1000 y '.now()->year.').',
        ];
    }
}
