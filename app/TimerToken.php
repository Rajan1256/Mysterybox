<?php

// SocialFacebookAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimerToken extends Model
{
    protected $table='timer_token';
    protected $primaryKey='TokenId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'TimeToken','CreatedAt','UpdatedAt'
    ];

}
