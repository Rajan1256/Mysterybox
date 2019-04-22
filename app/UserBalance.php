<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    protected $table='user_balances';
    protected $primaryKey='UserBalanceId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'UserId','Amount','CreatedAt','UpdatedAt'
    ];
}
