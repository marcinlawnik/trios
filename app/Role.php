<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 29.12.2016
 * Time: 23:07
 */
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name ',
        'description '
    ];
}