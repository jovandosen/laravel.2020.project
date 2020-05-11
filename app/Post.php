<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
