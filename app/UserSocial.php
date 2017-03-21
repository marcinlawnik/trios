<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'provider_id',
    ];

    static function getByProvider($provider, $providerId) {
        static::where('provider', $provider)->where('provider_id', $providerId)->first();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
