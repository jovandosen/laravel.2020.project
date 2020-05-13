<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Log;
use App\Role;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
	/**
	 * Create new Role instance
	 *
	 * @return void
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Show form for creating new Role
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return View::make('role.role');
    }

    /**
     * @param  \App\Http\Requests\RoleRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
    	$roleName = $request->input('roleName');
    	$roleDescription = $request->input('roleDescription');

    	$role = Role::create([
    		'roleName' => $roleName,
    		'roleDescription' => $roleDescription
    	]);

    	if($role){
    		Log::info('New Role Created.');
    		$request->session()->flash('roleCreated', 'You have successfully created Role.');
    		return redirect()->route('role.show');
    	}
    }

    /**
     * Display Role List 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$roles = Role::all();
    	return View::make('role.roles', ['roles' => $roles]);
    }
}
