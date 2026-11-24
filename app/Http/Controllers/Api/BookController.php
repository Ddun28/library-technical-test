<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\IndexBookRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of books, optionally filtered by category.
     */
    public function index(IndexBookRequest $request): AnonymousResourceCollection
    {
        $categoryId = $request->validated('category');

        $books = Book::query()
            ->with('category')
            ->filterByCategory($categoryId !== null ? (int) $categoryId : null)
            ->orderBy('title')
            ->get();

        return BookResource::collection($books);
    }

    /**
     * Store a newly created book.
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::query()->create($request->validated());

        return (new BookResource($book->load('category')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book): BookResource
    {
        return new BookResource($book->load('category'));
    }

    /**
     * Update the specified book.
     */
    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        $book->update($request->validated());

        return new BookResource($book->load('category'));
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book): Response
    {
        $book->delete();

        return response()->noContent();
    }
}
