<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    /*This will enable the relation with Role and add the following methods
     *roles(), hasRole($name), can($permission), and ability($roles, $permissions, $options).*/
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get trios which user attempted to solve.
     */
    public function triosAttempts()
    {
        return $this->hasMany('App\UserTrioAttempt')->orderBy('trio_id');
    }
}
