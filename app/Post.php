<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['userID', 'title', 'excerpt', 'content', 'image', 'categories'];
}
