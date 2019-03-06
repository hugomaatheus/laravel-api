<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();
        return $authors->toJson();
    }

    public function show(Author $author) {
        if(isset($author)) {
            return json_encode($author);
        }
        return response('Author not found', 404);
    }

    public function store(Request $request) {
        $author = Author::create($request->all());
        return json_encode($author);
    }

    public function update(Request $request, Author $author) {
        if(isset($author)) {
            $author->update($request->all());
            return json_encode($author);
        }
        return response('Author not found', 404);
    }

    public function destroy(Author $author) {
        if(isset($author)) {
            $author->delete();
            return response('OK', 200);
        }
        return response('Author not found', 404);
    }
}
