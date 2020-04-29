<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Http\Requests\MovieRequest;
use App\Movie;
use Log;
use Illuminate\Support\Facades\Gate;
use Auth;

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
        Gate::authorize('create-movie');
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

        Gate::authorize('delete-movie', $movie);

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
        $movieID = (int) $id;

        $movie = Movie::find($movieID);

        Gate::authorize('update-movie', $movie);

        $movieTitle = $request->input('title');
        $movieDescription = $request->input('description');
        $movieOldImage = $request->input('movieImage');
        $movieNewImage = $request->file('image');

        if( !empty($movieNewImage) ){
            if( $movieNewImage->isValid() ){

                $imageName = $movieNewImage->getClientOriginalName();
                $imageExtension = $movieNewImage->extension();
                $imagePath = $movieNewImage->path();

                if( file_exists( public_path( '/images/movies/' . $imageName ) ) ){
                    $random = rand(1, 10000);
                    $imgName = pathinfo($imageName, PATHINFO_FILENAME);
                    $img = $imgName . $random . '.' . $imageExtension;
                    $storeMovieImage = $movieNewImage->move( public_path('/images/movies/'), $img );
                    $image = $img;
                } else {
                    $storeMovieImage = $movieNewImage->move( public_path('/images/movies/'), $imageName );
                    $image = $imageName;
                }

                $movieOldImagePath = public_path('/images/movies/' . $movieOldImage);

                if( file_exists( $movieOldImagePath ) ){
                    unlink($movieOldImagePath);
                }

            }
        } else {
            $image = $movieOldImage;
        }

        $updatedAt = date("Y-m-d h:i:sa");

        $movie->title = $movieTitle;
        $movie->description = $movieDescription;
        $movie->image = $image;
        $movie->updated_at = $updatedAt;

        $movie->save();

        $request->session()->flash('movieUpdated', 'You have successfully updated Movie.');

        return redirect()->route('movie.edit', ['id' => $movieID]);

    }
}
