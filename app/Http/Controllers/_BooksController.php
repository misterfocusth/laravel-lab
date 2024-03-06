<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function getAll(Request $request)
    {
        $books = Books::latest()->filter([
            'title' => $request['title'],
            "author" => $request["author"],
            "publisher" => $request["publisher"],
        ])->get();

        if (count($books) === 0) {
            return response()->json([
                'message' => 'No books found'
            ], 404);
        }

        return response()->json($books);
    }

    public function create(Request $request)
    {
        $uniqueValidate = Validator::make($request->all(), [
            'title' => ['required', 'unique:books'],
        ]);


        if ($uniqueValidate->fails()) {
            return response()->json([
                'message' => $uniqueValidate->errors()
            ], 400);
        }

        $book = Books::create($request->all());

        return response()->json($book, 201);
    }

    public function get($id)
    {
        $book = Books::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        return response()->json($book);
    }

}
