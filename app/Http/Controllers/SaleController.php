<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Product;
use App\Sale;
use App\Seller;

class SaleController extends Controller
{
    /**
     * Display a listing of the sales
     *
     * @param  \App\Sale  $model
     * @return \Illuminate\View\View
     */
    public function index(Sale $model)
    {
        return view('sale.index', ['sales' => $model->with('seller')->paginate(15)]);
    }

    /**
     * Show the form for creating a new sale
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();
        $sellers = Seller::all();
        return view('sale.create', compact(['products', 'sellers']));
    }

    /**
     * Store a newly created sale in storage
     *
     * @param  \App\Http\Requests\SaleRequest  $request
     * @param  \App\Sale  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaleRequest $request, Sale $model)
    {
        $sale = $model->create($request->except(['products']));
        $sale->products()->attach($request->get('products'));

        return redirect()->route('sale.index')->withStatus(__('Sale successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale $sale
     * @return \Illuminate\View\View
     */
    public function show(Sale $sale)
    {
        return view('sale.view', compact('sale'));
    }

    /**
     * Show the form for editing the specified sale
     *
     * @param  \App\Sale $sale
     * @return \Illuminate\View\View
     */
    public function edit(Sale $sale)
    {
        $products = Product::all();
        $sellers = Seller::all();
        $sale->with(['seller', 'products'])->get();
        return view('sale.edit', compact(['sale', 'products', 'sellers']));
    }

    /**
     * Update the specified sale in storage
     *
     * @param SaleRequest $request
     * @param Sale $sale
     * @return mixed
     */
    public function update(SaleRequest $request, Sale $sale)
    {
        $sale->update($request->all());
        $sale->products()->sync($request->get('products'));

        return redirect()->route('sale.index')->withStatus(__('Sale successfully updated.'));
    }

    /**
     * Remove the specified sale from storage
     *
     * @param Sale $sale
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sale.index')->withStatus(__('Sale successfully deleted.'));
    }
}
