<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrioChange extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trio_id',
        'user_id',
        'field_name',
        'before',
        'after',
    ];

    /*
     * Get the Trio which was updated.
     */
    public function trio()
    {
        return $this->belongsTo('App\Trio');
    }
}
