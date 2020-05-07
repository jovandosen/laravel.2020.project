<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
	 * Post model table
	 *
	 * @var string
	 */
    protected $table = 'posts';

    /**
     * Post model fillable properties
     *
     * @var array
     */
    protected $fillable = ['userID', 'title', 'excerpt', 'content', 'image', 'categories'];

    /**
     * Define posts owner
     */
    public function user()
    {
    	return $this->belongsTo('App\User', 'userID');
    }
}
