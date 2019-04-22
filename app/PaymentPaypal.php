<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPaypal extends Model
{
    protected $table='payments';
    protected $primaryKey='Id';

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    protected $fillable = [
        'UserId','PaymentId','PayerId','Token','Amount','Currency','CreatedAt','UpdatedAt'
    ];


}
