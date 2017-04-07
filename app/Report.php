<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{

    use SoftDeletes;
    protected $fillable = ['trio_id', 'description'];

    protected $dates = ['deleted_at'];

    public function trio()
    {
        return $this->belongsTo('App\Trio');
    }
}
