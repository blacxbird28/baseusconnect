<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $fillable = [
        'title', 'slug', 'short_description', 'content', 'platform', 'url', 'user_id', 'images'
    ];
}
