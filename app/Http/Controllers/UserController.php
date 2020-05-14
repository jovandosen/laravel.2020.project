<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\RoleUser;

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
     * Display form for assigning roles to user
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

    	$userRoles = $user->roles;

    	$data = [];

    	if( !empty($userRoles) ){
    		foreach ($userRoles as $key => $value) {
    			$data[] = $value->id;
    		}
    	} 

    	return view('user_roles', ['user' => $user, 'roles' => $roles, 'userRoles' => $data]);
    }

    /**
     * Assign roles to user
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function assignRolesToUser(Request $request)
    {
    	$userID = $request->input('userID');
    	$roles = $request->input('userRoles');

    	$userRolesData = RoleUser::where("user_id", $userID)->get();

    	if( ! $userRolesData->isEmpty() ){
    		// update roles

    		$details = [];

    		foreach ($userRolesData as $k => $v) {
    			if( ! in_array($v->role_id, $roles) ){
    				$v->delete();
    			}
    			$details[] = $v->role_id;
    		}

    		$roleDiff = array_diff($roles, $details);

    		if( !empty($roleDiff) ){
    			foreach ($roleDiff as $ke => $va) {
    				$roleRecord = RoleUser::create([
    					'user_id' => $userID,
    					'role_id' => $va
    				]);
    			}
    		}

    		// redirect
    		$request->session()->flash('rolesUpdated', 'You have successfully updated User Roles.');
    		return redirect()->route('assign.roles', ['id' => $userID]);

    	} else {
    		//create roles

    		if(!empty($roles)){

	    		foreach ($roles as $key => $role) {
	    			$roleRecord = RoleUser::create([
	    				'user_id' => $userID,
	    				'role_id' => $role
	    			]);
	    		}

	    		// redirect
	    		$request->session()->flash('rolesAssigned', 'You have successfully assigned Roles to User.');
	    		return redirect()->route('assign.roles', ['id' => $userID]);
    		}

    	}
    }
}
