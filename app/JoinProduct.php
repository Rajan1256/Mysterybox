<?php

// SocialFacebookAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinProduct extends Model
{
    protected $table='join_products';
    protected $primaryKey='JoinId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'MysteryboxId','MysteryboxProductId','CreatedAt','UpdatedAt'
    ];

    public function Products()
    {
        return $this->hasMany('App\Product', 'MysteryboxProductId', 'MysteryboxProductId');
    }

}
