<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories with their books count.
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::query()
            ->withCount('books')
            ->orderBy('name')
            ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::query()->create($request->validated());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category->loadCount('books'));
    }

    /**
     * Update the specified category.
     */
    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified category if it has no associated books.
     */
    public function destroy(Category $category): JsonResponse|Response
    {
        if ($category->books()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar la categoría porque tiene libros asociados.',
                'code' => 'CATEGORY_HAS_BOOKS',
                'books_count' => $category->books()->count(),
            ], Response::HTTP_CONFLICT);
        }

        $category->delete();

        return response()->noContent();
    }
}
