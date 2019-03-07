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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required'
        ]);

        $book->update($data);

        return $book;
    }

    public function destroy(Book $book) 
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
