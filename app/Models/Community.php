<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    //
    protected $table = 'community';

    protected $fillable = [
        'name', 'description', 'location', 'images', 'status'
    ];
}
