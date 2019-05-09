<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'id',
        'id_seller'
    ];
    protected $appends = [
        'total_price'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo('App\Seller', 'id_seller', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_sale', 'sale_id', 'product_id');
    }

    /**
     * @return float
     */
    public function getTotalPriceAttribute()
    {
        return $this->calculateTotalAmount();
    }

    /**
     * @return float
     */
    private function calculateTotalAmount()
    {
        $sum = 0;
        $this->products()->get()->map(function ($product) use (&$sum) {
            $sum =+ $product->price;
        });

        return $sum;

    }
}
