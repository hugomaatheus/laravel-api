<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Author;

class AuthorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */    

    protected $authorJsonStructure  = [  
        'id',
        'name',
        'age',
        'email',                
        'created_at',
        'updated_at'        
    ];

    /**
     * @test
     */
    public function authorShouldBeListedCorrectly()
    {

        $authors = factory(Author::class, 3)->create();

        $this->withHeaders([
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('authors.index'))
            ->assertStatus(200)
            ->assertJson(['data' => $authors->toArray()])
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->authorJsonStructure
                ]
            ]);          
    }

    /**
    * @test
    */
    public function authorShouldBeVisualizedCorrectly()
    {
        $author = factory(Author::class)->create();
        
        $this->withHeaders([
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('authors.show', $author->id))
            ->assertStatus(200)
            ->assertJson(['data' => $author->toArray()])
            ->assertJsonStructure(['data' => $this->authorJsonStructure]);
    }

    /**
    * @test
    */
    public function authorShouldBeUpdatedCorrectly()
    {
        $name = 'Michael Jordan';

        $author = factory(Author::class)->create();

        $author->name = $name;

        $this->withHeaders([
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('PUT', route('authors.update', $author->id), $author->toArray())
            ->assertStatus(200)
            ->assertJson(['data' => ['name' => $name]])
            ->assertJsonStructure(['data' => $this->authorJsonStructure]);
        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => $name
        ]);
    }

    /**
    * @test
    */
    public function authorShouldBeDeletedCorrectly()
    {
        $author = factory(Author::class)->create();

        $this->json('DELETE', route('authors.destroy', $author->id))
            ->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }

    /**
     * @test
     */
    public function authorShoulReturnNotFound()
    {
        $author = factory(Author::class)->create();
        $this->json('DELETE', route('authors.destroy', $author->id));
        $this->withHeaders([
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('authors.show', $author->id))
            ->assertStatus(404);
    }

}
