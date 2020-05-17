<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$numberOfProducts = 50;

    	for($i = 0; $i < $numberOfProducts; $i++){
    		$product = DB::table('products')->insert([
	        	'user_id' => 25,
	        	'name' => Str::random(8),
	        	'manufacturer' => Str::random(10),
	        	'price' => rand(10, 1000),
	        	'quantity' => rand(1, 1000),
	        	'description' => Str::random(50),
	        	'images' => '',
        	]);
    	}
    }
}
