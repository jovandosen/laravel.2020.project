<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['user_id', 'name', 'manufacturer', 'price', 'quantity', 'description', 'images'];
}
