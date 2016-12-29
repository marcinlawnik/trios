<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTrioAttempt extends Model
{
    protected $fillable = [
        'trio_id',
        'user_id',
        'attempts',
        'solved',
    ];
    
}
