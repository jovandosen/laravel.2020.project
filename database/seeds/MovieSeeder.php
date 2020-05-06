<?php

use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	$user = DB::table('movies')->insert([
     		'user_id' => 1,
        	'title' => Str::random(10),
        	'description' => Str::random(40),
        	'image' => Str::random(5) . '.jpg',
        ]);  
    }
}
