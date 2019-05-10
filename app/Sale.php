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
        return $this->calculateTotalPrice();
    }

    /**
     * @return float
     */
    private function calculateTotalPrice()
    {
        $sum = 0;
        $this->products()->get()->map(function ($product) use (&$sum) {
            $sum = $product->price + $sum;
        });

        return $sum;
    }

    public static function chartValue()
    {
        $sales = self::selectRaw('count(*) as total, MONTH(created_at) as month')
        ->whereRaw('YEAR(created_at) = '.date('Y'))
        ->groupBy('month')
        ->get();

        return $sales;
    }

    public static function chartOrders()
    {
        $sales = self::selectRaw('count(*) as total, YEAR(created_at) as year')
            ->groupBy('year')
            ->get();

        return $sales;
    }

    public static function gridSellers()
    {
        $sellers = self::selectRaw("
                        SUM(CASE
                            WHEN MONTH(sales.created_at) =  MONTH(NOW()) THEN 1
                            ELSE 0
                        END) AS 'current_month',
                        SUM(CASE
                            WHEN MONTH(sales.created_at) =  MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) THEN 1
                            ELSE 0
                        END) AS 'last_month',
                        sellers.name")
            ->join('sellers', 'sales.id_seller', '=', 'sellers.id')
            ->limit(5)
            ->groupBy('sellers.name')
            ->orderBy('current_month', 'DESC')
            ->get();

        return $sellers;
    }

    public static function gridProducts()
    {
        $products = self::selectRaw("
                        COUNT(product_sale.product_id) AS 'amount',
                        products.name")
            ->join('product_sale', 'product_sale.sale_id', '=', 'sales.id')
            ->join('products', 'products.id', '=', 'product_sale.product_id')
            ->limit(5)
            ->groupBy('products.name')
            ->orderBy('amount', 'DESC')
            ->get();

        return $products;
    }
}
