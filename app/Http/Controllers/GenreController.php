<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Auth;
use Log;
use App\Genre;
use App\Http\Requests\GenreRequest;
use Illuminate\Support\Facades\Gate;

class GenreController extends Controller
{
	/**
	 * Create new Genre instance
	 *
	 * @return void
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Show form for creating new Genre record
     *
     * @return \Illuminate\Http\Response 
     */
    public function create()
    {
    	Gate::authorize('create-genre');
    	return View::make('genre.genre');
    }

    /**
     * Store Genre record in database
     *
     * @param  \App\Http\Requests\GenreRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
    	$userID = $request->input('userID');
    	$genreName = $request->input('name');
    	$genreDescription = $request->input('description');

    	$userID = (int) $userID;

    	$genre = Genre::create([
    		'user_id' => $userID,
    		'name' => $genreName,
    		'description' => $genreDescription
    	]);

    	if( $genre ){
    		Log::info('New Genre Created.');
    		$request->session()->flash('genreCreated', 'You have successfully created Genre.');
    		return redirect()->route('genre.show');
    	}
    }

    /**
     * Display Genre list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$genres = Genre::all();
    	return View::make('genre.genres', ['genres' => $genres]);
    }

    /**
     * Delete genre record
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    	$genreID = (int) $id;

    	$genre = Genre::find($genreID);

    	Gate::authorize('delete-genre', $genre);

    	$genre->delete();

    	$request->session()->flash('genreDeleted', 'You have successfully deleted Genre.');

        return redirect()->route('genre.list');
    }
}
