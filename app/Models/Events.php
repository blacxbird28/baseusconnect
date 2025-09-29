<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    //
    protected $table = 'events';

    protected $fillable = [
        'title', 'slug', 'short_description', 'content', 'date', 'location', 'maps', 'images', 'status', 'drive_url'
    ];
}
