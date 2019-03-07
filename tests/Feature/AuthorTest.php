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

    //testing method POST
    public function testPost()
    {
        $author = factory(Author::class)->make();

        $response = $this->json('POST', 'api/authors', $author->toArray());

        $response->assertStatus(201);
    }

    //testing method GET
    public function testGet()
    {
        $response = $this->json('GET', 'api/authors');

        $response->assertStatus(200);
    }

    //testing method PUT
    public function testPut() 
    {
        $author = factory(Author::class)->make();

        $response = $this->json('PUT', 'api/authors/1', $author->toArray());

        $response->assertStatus(200);
    }

    //testing method DELETE
    public function testDelete()
    {
        $response = $this->json('DELETE', 'api/authors/1');

        $response->assertStatus(204);
    }

}
