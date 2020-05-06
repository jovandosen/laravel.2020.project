<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('posts')->insert([
        	'userID' => 1,
        	'title' => Str::random(10),
        	'excerpt' => Str::random(20),
        	'content' => Str::random(30),
        ]);
    }
}
