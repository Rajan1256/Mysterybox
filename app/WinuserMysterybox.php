<?php

// SocialFacebookAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WinuserMysterybox extends Model
{
    protected $table='winuser_mysteryboxs';
    protected $primaryKey='WinMysteryboxId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'BidId','MysteryboxStatus','IsDeleted','CreatedAt','UpdatedAt'
    ];


    public function bid()
    {
        return $this->hasOne('App\Bid', 'BidId', 'BidId');
    }

}
