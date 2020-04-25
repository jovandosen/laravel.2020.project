<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
     * Create a new post controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display post form for creating new Post
	 *
	 * @return \Illuminate\Http\Response 
	 */
    public function create()
    {
    	return view('post');
    }

    /**
     * Store a newly created Post in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$postValidatedData = $request->validate([
    		'title' => 'required|unique:posts|max:255',
    		'excerpt' => 'required',
    		'content' => 'required|min:3',
    	]);
    }
}
