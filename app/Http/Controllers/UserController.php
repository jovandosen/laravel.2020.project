<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
	/**
	 * Create new User instance
	 *
	 * @return void
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Display User List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();
    	return view('users', ['users' => $users]);
    }

    /**
     * Assign roles to user
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function assignRoles($id)
    {
    	$userID = (int) $id;

    	$user = User::find($userID);

    	$roles = Role::all();

    	return view('user_roles', ['user' => $user, 'roles' => $roles]);
    }
}
