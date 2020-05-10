<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Post;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test if specific record exists in database
     *
     * @return void
     */
    public function testDatabase()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    /**
     * Test if specific record is missing form database
     *
     * @return void
     */
    public function testDatabaseRecordMissing()
    {
        $this->assertDatabaseMissing('users', ['email' => 'foo@gmail.com']);
    }

    /**
     * Test if post exists
     *
     * @return void
     */
    public function testPost()
    {
        $post = factory(Post::class)->create();
        $this->assertDatabaseHas('posts', ['title' => $post->title]);
    }

    /**
     * Test if post is missing
     *
     * @return void
     */
    public function testPostMissing()
    {
        $this->assertDatabaseMissing('posts', ['title' => 'abc']);
    }

    public function testUserDeleted()
    {
        $user = factory(User::class)->create();
        $user->delete();
        $this->assertDeleted($user);
    }
}
