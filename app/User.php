<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','google_id','facebook_id','ProfileImage','RoleId','Dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getAdminByColumnName($columnName, $value, $column = NULL)
    {
        $getUser = User::where($columnName, $value)->where('RoleId', 1)->first();
        if ($column != NULL) {
            if (isset($getUser->$column)) {
                return $getUser->$column;
            }
            return false;
        }
        return $getUser;
    }
}
