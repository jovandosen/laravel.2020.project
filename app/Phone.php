<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
	/**
	 * Phone model table
	 *
	 * @var string
	 */
    protected $table = 'phones';

    /**
     * Phone model fillable properties
     *
     * @var array
     */
    protected $fillable = ['user_id', 'phone'];

    /**
     * Get the User that owns this Phone number
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
