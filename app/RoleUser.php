<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
	/**
	 * User Roles table
	 *
	 * @var string
	 */
    protected $table = 'role_user';

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id'];
}
