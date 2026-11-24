<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| The endpoints are exposed at the root level (without the "/api" prefix)
| to match the contract required by the technical test:
|
|   GET    /books
|   POST   /books
|   GET    /books/{book}
|   PUT    /books/{book}
|   DELETE /books/{book}
|   GET    /books?category={category_id}
|
*/

Route::apiResource('books', BookController::class)->except('update');
Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');

Route::apiResource('categories', CategoryController::class)->except('update');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
