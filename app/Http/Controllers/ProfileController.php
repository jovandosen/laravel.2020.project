<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\User;

class ProfileController extends Controller
{
	/**
	 * Create new Profile instance
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show profile form
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function profile()
    {
    	return View::make('profile.profile');
    }

    /**
     * Update profile data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
	 *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	//
    }
}
