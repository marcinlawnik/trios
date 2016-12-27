<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WrongAnswer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trio_id',
        'answer'
    ];

    /*
     * Get the Trio which was answered.
     */
    public function trio()
    {
        return $this->belongsTo('App\Trio');
    }
}
