<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function show($id)
    {
        $validation = Validator::make(['id' => $id], [
            'id' => ['required']
        ]);

        if ($validation->fails())
            return response('Validation failed.' . $validation->errors(), 400);

        $todo = Http::get('https://jsonplaceholder.typicode.com/todos/' . $id)->json();

        if (empty($todo))
            return response('Todo not found.', 404);

        return response($todo)->header('Content-Type', 'application/json');


    }
}
