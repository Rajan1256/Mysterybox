<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{

    protected $table='user_infos';
    protected $primaryKey='UserInfoId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';


    protected $fillable = [
        'UserId','FirstName', 'LastName', 'PostalCode','Address','CountryId','StateId','CityId','ContactName','TelePhone','MobileNo','CreatedAt','UpdatedAt'
    ];

}
