<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function index() {
        $books = Book::with(['author'])->get();
        return $books->toJson();
    }

    public function show(Book $book) {
        if(isset($book)) {
            return json_encode($book);
        }
        return response('Book not found', 404);
    }

    public function store(Request $request) {
        $book = Book::create($request->all());
        return json_encode($book);
    }

    public function update(Request $request, Book $book) {
        if(isset($book)) {
            $book->update($request->all());
            return json_encode($book);
        }
        return response('Book not found', 404);
    }

    public function destroy(Book $book) {
        if(isset($book)) {
            $book->delete();
            return response('OK', 200);
        }
        return response('Book not found', 404);
    }
}
