<?php

// SocialFacebookAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='mysterybox_products';
    protected $primaryKey='MysteryboxProductId';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'UserId','ProductName','ProductPrice','ProductImage','IsDeleted','CreatedAt','UpdatedAt'
    ];
}
