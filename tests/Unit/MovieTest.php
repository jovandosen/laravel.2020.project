<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;

class MovieTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Test json movie resource
     *
     * @return void
     */
    public function testMovieResource()
    {
    	$response = $this->withCookie('dev', 'development')->get('/baz');

    	// $response->dump();

    	$response->assertStatus(200);
    }

    /**
     * Test data response
     *
     * @return void
     */
    public function testMovieResourceData()
    {
    	$response = $this->getJson('/resource/movie', ["title" => "foo"]);

    	// $response = $this->getJson('/resource/movie');

    	// $response->dump();

    	$response->assertStatus(200);

    	// $response->assertStatus(200)->assertJson(["description" => "foo description"]);
    }

    /*public function testUserDetails()
    {
    	$response = $this->get('/baz');

    	// $response->dump();

    	$data = [];

    	$user = User::find(1);

    	$data[] = $user;

    	$response->assertStatus(200)->assertExactJson($data);
    }*/
}
