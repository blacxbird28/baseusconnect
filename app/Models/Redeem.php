<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $table = 'redeem';

    protected $fillable = [
        'user_id', 'prize_id', 'status'
    ];
}
