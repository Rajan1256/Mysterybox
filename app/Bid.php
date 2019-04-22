<?php

// SocialFacebookAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table='bids';
    protected $primaryKey='BidId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'MysteryboxId','StartTime','AutoBotId','UserId','BidPrice','BidStatus','IsDeleted','CreatedAt','UpdatedAt'
    ];


    public function user()
    {
        return $this->hasMany('App\User', 'id', 'UserId');
    }

    public function autobot()
    {
        return $this->hasMany('App\AutoBot', 'AutoBotId', 'AutoBotId');
    }
}
