<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Books::latest()->filter([
            'title' => $request['title'],
            "author" => $request["author"],
            "publisher" => $request["publisher"],
        ])->with('author')->get();

        if (count($books) === 0) {
            return response()->json([
                'message' => 'No books found'
            ], 404);
        }

        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => ['required', Rule::unique('books', 'title')],
            'author_id' => ['required', Rule::exists('users', 'id')],
            "rating" => ['required', Rule::in(['EVERYONE', 'TEEN', 'ADULT'])]
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()
            ], 400);
        }

        $book = Books::create($request->all());

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Books::find($id);

        $book['author'] = $book->author;

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getBooksByAuthor(string $authorId)
    {
        $author = User::find($authorId);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        $books = Books::where('author_id', $authorId)->get();

        if (count($books) === 0) {
            return response()->json([
                'message' => 'No books found'
            ], 404);
        }

        return response()->json($books);
    }
}
