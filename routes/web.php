<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "World";
});

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