<?php

// SocialFacebookAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoBot extends Model
{
    protected $table='auto_bots';
    protected $primaryKey='AutoBotId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'UserName','IsDeleted','CreatedAt','UpdatedAt'
    ];

}
