<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Author;

class AuthorController extends Controller
{
    public function index() 
    {
        $authors = Author::all();

        return $authors;
    }

    public function show(Author $author) 
    {
        return $author;
    }

    public function store(Request $request) 
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required',
            'email' => 'required|email|unique:authors,email',
            'password' => 'confirmed|string|min:8',
            'password_confirmation' => 'required|string|min:8'
        ]);

        $data["password"] = bcrypt(request('password'));

        $author = Author::create($data);

        return response()->json($author, 201);
    }

    public function update(Request $request, Author $author) 
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('authors')->ignore($author->id),
            ],
            'password' => 'confirmed|string|min:8',
            'password_confirmation' => 'required|string|min:8'
        ]);
        
        $data["password"] = bcrypt(request('password'));

        $author->update($data);

        return $author;
    }

    public function destroy(Author $author) 
    {
        $author->delete();

        return response()->json(null, 204);
    }
}
