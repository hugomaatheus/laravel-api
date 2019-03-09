<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Author;
use App\Book;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $bookJsonStructure = [
        'id',
        'title',
        'author_id',
        'created_at',
        'updated_at'
    ]; 

    /**
     * @test
     */
    public function bookShouldBeListedCorrectly()
    {           
        $books = factory(Book::class, 3)->create();

        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])
            ->json('GET', route('books.index'))
            ->assertStatus(200)
            ->assertJson(['data' => $books->toArray()])
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->bookJsonStructure
                ]
            ]);
    }

    /**
    * @test
    */
    public function bookShouldBeVisualizedCorrectly()
    {
        $book = factory(Book::class)->create();
        
        $this->withHeaders([
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('books.show', $book->id))
            ->assertStatus(200)
            ->assertJson(['data' => $book->toArray()])
            ->assertJsonStructure(['data' => $this->bookJsonStructure]);
    }

    /**
    * @test
    */
    public function bookShouldBeUpdatedCorrectly()
    {
        $title = 'Song of Fire and Ice';
        $book = factory(Book::class)->create();
        $book->title = $title;

        $this->withHeaders([
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('PUT', route('books.update', $book->id), $book->toArray())
            ->assertStatus(200)
            ->assertJson(['data' => ['title' => $title]])
            ->assertJsonStructure(['data' => $this->bookJsonStructure]);
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $title
        ]);
    }

    /**
    * @test
    */
    public function bookShouldBeDeletedCorrectly()
    {
        $book = factory(Book::class)->create();

        $this->json('DELETE', route('books.destroy', $book->id))
            ->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * @test
     */
    public function bookShoulReturnNotFound()
    {
        $book = factory(Book::class)->create();

        $this->json('DELETE', route('books.destroy', $book->id));
        $this->withHeaders([
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('books.show', $book->id))
            ->assertStatus(404);
    }
}
