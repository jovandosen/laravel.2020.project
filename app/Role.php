<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * Role table
	 *
	 * @var string
	 */
    protected $table = 'roles';

    /**
     * Role properties that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['user_id', 'roleName', 'roleDescription'];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
