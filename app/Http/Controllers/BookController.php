<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function index() 
    {
        $books = Book::with(['author'])->get();

        return $books;
    }

    public function show(Book $book) 
    {
        return $book;
    }

    public function store(Request $request) 
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required'
        ]);

        $book = Book::create($data);

        return response()->json($book, 201);
    }

    public function update(Request $request, Book $book) 
    {
        if (isset($book)) 
        {
            $book->update($request->all());
            return json_encode($book);
        }
        return response('Book not found', 404);
    }

    public function destroy(Book $book) 
    {
        if (isset($book)) 
        {
            $book->delete();
            return response('OK', 200);
        }
        return response('Book not found', 404);
    }
}
