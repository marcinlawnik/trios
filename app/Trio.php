<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sentence1',
        'sentence2',
        'sentence3',
        'explanation1',
        'explanation2',
        'explanation3',
        'answer'
    ];
}
