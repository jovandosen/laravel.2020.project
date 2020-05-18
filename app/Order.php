<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	/**
	 * Order table
	 *
	 * @var string
	 */
    protected $table = 'orders';

    /**
     * Fillable attributes of Order
     *
     * @var array
     */
    protected $fillable = ['user_id', 'products'];

    /**
     * Get the User that ordered Products
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
