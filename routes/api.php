<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/health', function () {
    return response()->json([
        'health' => 'ok',
        'services' => [
            ['name' => 'auth', 'status' => 1],
            ['name' => 'storage', 'status' => 1]
        ]
    ]);
});

Route::post('/user', function (Request $request) {
    $email = $request->get('email');
    return response('You just made a POST request with ' . $email . " as the email.");
});

// USER: Register
Route::post('/user/register', [UserController::class, 'store']);

// Get ToDo By ID
Route::get('/todo/{id}', [TodoController::class, 'show']);

// BOOKS: GET All Books
Route::get('/books', [BooksController::class, 'index']);

// BOOKS: Get Book By ID
Route::get('/books/{id}', [BooksController::class, 'show']);

// BOOKS: POST Create Book
Route::post('/books', [BooksController::class, 'store']);

// BOOKS: Get Books By Author ID
Route::get('/authors/{author}/books', [BooksController::class, 'getBooksByAuthor']);