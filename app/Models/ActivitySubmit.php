<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitySubmit extends Model
{
    //
    protected $table = 'activity_submit';

    protected $fillable = [
        'user_id', 'activity_id', 'images'
    ];
}
