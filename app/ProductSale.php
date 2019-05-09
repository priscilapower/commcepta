<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSale extends Pivot
{
    protected $table = 'product_sale';
    protected $fillable = [
        'sale_id',
        'product_id',
    ];

    public $timestamps = false;
}
