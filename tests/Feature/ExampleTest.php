<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        // $response = $this->withCookie('color', 'blue')->get('/');

        // $response->dumpHeaders();

        // $response->dumpSession();

        // $response->dump();

        $response->assertStatus(200);
    }

    /**
     * Test Foo
     *
     * @return void
     */
    public function testFooTest()
    {
        // $response = $this->get('/foo');

        $response = $this->withSession(['aaa' => 'bbb'])->get('/foo');

        // aaa is successfully set in session

        // $response->dumpSession();

        // $response->dump();

        $response->assertStatus(200)->assertSessionHas('aaa', 'bbb'); // works well
    }

    /**
     * Test Bar
     *
     * @return void
     */
    public function testBarTest()
    {
        $response = $this->get('/bar');

        // $response->dump();

        $response->assertStatus(200);
    }
}
