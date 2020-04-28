<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Http\Requests\MovieRequest;
use App\Movie;
use Log;

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
 	 * @param  App\Http\Requests\MovieRequest  $request
 	 *		
 	 * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
    	$userID = $request->input('userID');
    	$movieTitle = $request->input('title');
    	$movieDescription = $request->input('description');
    	$movieImage = $request->file('image');

    	if( !empty($movieImage) ){
    		if( $movieImage->isValid() ){
    			$imageName = $movieImage->getClientOriginalName();
                $imageExtension = $movieImage->extension();
                $imagePath = $movieImage->path();

                if( file_exists( public_path('/images/movies/' . $imageName) ) ){
                	$random = rand(1, 10000);
                    $imgName = pathinfo($imageName, PATHINFO_FILENAME);
                    $img = $imgName . $random . '.' . $imageExtension;
                    $storeMovieImage = $movieImage->move( public_path('/images/movies/'), $img );
                    $image = $img;
                } else {
                	$storeMovieImage = $movieImage->move( public_path('/images/movies/'), $imageName );
                	$image = $imageName;
                }

    		}
    	} else {
    		$image = '';
    	}

    	$movie = Movie::create([
    		'user_id' => $userID,
    		'title' => $movieTitle,
    		'description' => $movieDescription,
    		'image' => $image
    	]);

    	if( $movie ){
    		Log::info('New Movie Created.');
    		$request->session()->flash('movieCreated', 'You have successfully created Movie.');
    		return redirect()->route('movie.show');
    	}
    }

    /**
     * Display Movie list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$movies = Movie::all();
    	return View::make('movie.movies', ['movies' => $movies]);
    }

    /**
     * Delete Movie record
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id 
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    	$movieID = (int) $id;

    	$movie = Movie::find($movieID);

    	$movieImg = $movie->image;

    	$movie->delete();

    	$movieImgPath = public_path('/images/movies/' . $movieImg);

    	if( file_exists( $movieImgPath ) ){
    		unlink($movieImgPath);
    	}

    	$request->session()->flash('movieDeleted', 'You have successfully deleted Movie.');

        return redirect()->route('movie.list');
    }

    /**
     * Show form for editing Movie
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movieID = (int) $id;

        $movie = Movie::find($movieID);

        return view('movie.edit_movie', ['movie' => $movie]);
    }

    /**
     * Update Movie details
     *
     * @param  App\Http\Requests\MovieRequest  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, $id)
    {
        var_dump($id);
    }
}
