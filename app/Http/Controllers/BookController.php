<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Resources\Book as BookResource;

class BookController extends Controller
{
    public function index() 
    {
        return BookResource::collection(Book::paginate());
    }

    public function show(Book $book) 
    {
        return new BookResource($book);
    }

    public function store(Request $request) 
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required'
        ]);

        $book = Book::create($data);

        return (new BookResource($book))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, Book $book) 
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required'
        ]);

        $book->update($data);

        return new BookResource($book);
    }

    public function destroy(Book $book) 
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
