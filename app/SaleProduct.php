<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SaleProduct extends Pivot
{
    protected $table = 'sales_products';
    protected $fillable = [
        'id_sale',
        'id_product'
    ];
}
