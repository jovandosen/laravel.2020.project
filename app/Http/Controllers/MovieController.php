<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class MovieController extends Controller
{
	/**
	 * Create a new Movie instance
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display form for new Movie
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function create()
    {
    	return View::make('movie.movie');
    }

    /**
 	 * Store new movie
 	 *
 	 * @param  \Illuminate\Http\Request  $request
 	 *		
 	 * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$movieValidatedData = $request->validate([
    		'title' => "required|max:255|unique",
    		'description' => 'required|min:3',
    		'image' => 'required',
    	]);
    }
}
