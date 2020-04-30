<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Http\Requests\MovieRequest;
use App\Movie;
use Log;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Genre;

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
        $genres = Genre::all();
    	return View::make('movie.movie', ['genres' => $genres]);
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
        $movieGenres = $request->input('movieGenres');

        if( !empty($movieGenres) ){
            $movieGenres = serialize($movieGenres);
        } else {
            $movieGenres = '';
        }

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
    		'image' => $image,
            'genres' => $movieGenres
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

        $genres = $movie->genres;

        if( !empty($genres) ){
            $genres = unserialize($genres);
        } else {
            $genres = '';
        }

        $allGenres = Genre::all();

        return view('movie.edit_movie', ['movie' => $movie, 'genres' => $genres, 'allGenres' => $allGenres]);
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

        $movieGenres = $request->input('movieGenres');

        if( !empty($movieGenres) ){
            $movieGenres = serialize($movieGenres);
        } else {
            $movieGenres = '';
        }

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
        $movie->genres = $movieGenres;

        $movie->save();

        $request->session()->flash('movieUpdated', 'You have successfully updated Movie.');

        return redirect()->route('movie.edit', ['id' => $movieID]);

    }
}
