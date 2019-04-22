<?php

// SocialFacebookAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MysteryBox extends Model
{
    protected $table='mysteryboxs';
    protected $primaryKey='MysteryboxId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'UserId','MysteryboxName','MysteryboxBasePrice','ProbabilityPercentage','DummyUserMaxPrice','Description','BoxStatus','IsDeleted','CreatedAt','UpdatedAt'
    ];

}
