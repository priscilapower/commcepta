<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use App\Seller;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sales = Sale::all();
        $products = Product::all();
        $sellers = Seller::all();
        $totalMoney = $this->getTotalMoney();
        $sellersTop5 = Sale::gridSellers();
        $productsTop5 = Sale::gridProducts();
        return view('dashboard', compact(['sales', 'products', 'sellers', 'totalMoney', 'sellersTop5', 'productsTop5']));
    }

    public function chartValue()
    {
        $sales = Sale::chartValue();
        $return = [];

        $sales->map(function ($sale) use (&$return) {
            $return['label'][] = date("F", mktime(0, 0, 0, $sale->month, 1));
            $return['data'][] = $sale->total;
        });

        return JsonResponse::create($return);
    }

    public function chartOrders()
    {
        $sales = Sale::chartOrders();
        $return = [];

        $sales->map(function ($sale) use (&$return) {
            $return['label'][] = $sale->year;
            $return['data'][] = $sale->total;
        });

        return JsonResponse::create($return);
    }

    private function getTotalMoney()
    {
        $sales = Sale::all();
        $sum = 0;
        $sales->map(function ($sale) use (&$sum) {
            $total = $sale->getTotalPriceAttribute();
            $sum = $total + $sum;
        });

        return $sum;
    }
}
