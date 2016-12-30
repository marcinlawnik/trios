<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 29.12.2016
 * Time: 23:10
 */
namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
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