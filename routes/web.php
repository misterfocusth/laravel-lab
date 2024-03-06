<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BooksController::class, 'getPopularBooks']);

Route::get('/hello', function () {
    return "World";
});

// Register
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->middleware('guest');

// Login
Route::get('/login', [UserController::class, 'index'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('html', function () {
    return '<h1>Hello World</h1>';
});

Route::get('plain', function () {
    return response('<h1>Hello World</h1>', 200)
        ->header('Content-Type', 'text/plain');
});

Route::get('/user/{id}', function ($id) {
    return 'Welcome user id: ' . $id;
});

Route::get('/user', function (Request $request) {
    $name = $request->get('name');
    return 'Hello user: ' . $name;
});