<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
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
    	//
    }
}
