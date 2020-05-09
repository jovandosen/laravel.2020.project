<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class SimpleTestData extends TestCase
{
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
	 * Test a console command.
	 *
	 * @return void
	 */
	public function testConsoleCommand()
	{
	    $this->artisan('simple:test')
	         ->expectsQuestion('What is your name?', 'Jovan Dosen')
	         ->expectsQuestion('Which language do you program in?', 'PHP')
	         ->expectsOutput('Your name is Jovan Dosen and you program in PHP.')
	         ->assertExitCode(0);
	}
}
