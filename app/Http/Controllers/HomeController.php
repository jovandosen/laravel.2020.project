<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if( !empty( $request->search ) ){

            $search = $request->search;

            $movies = DB::table('movies')
                                    ->where('title', 'like', "%$search%")
                                    ->orWhere('description', 'like', "%$search%")
                                    ->paginate(3);                    

            return view('home', ['movies' => $movies]);

        } else {
            $movies = Movie::paginate(5);
            return view('home', ['movies' => $movies]);
        }
    }
}
