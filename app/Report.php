<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['trio_id', 'description'];

    public function trio()
    {
        return $this->belongsTo('App\Trio');
    }
}
