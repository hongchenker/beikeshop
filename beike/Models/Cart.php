<?php

namespace Beike\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Base
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'shipping_address_id', 'shipping_method_code', 'payment_address_id', 'payment_method_code'
    ];
}
