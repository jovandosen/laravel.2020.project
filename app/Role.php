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
    protected $fillable = ['roleName', 'roleDescription'];
}
