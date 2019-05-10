<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products
     *
     * @param  \App\Product  $model
     * @return \Illuminate\View\View
     */
    public function index(Product $model)
    {
        return view('product.index', ['products' => $model->paginate(10)]);
    }

    /**
     * Show the form for creating a new product
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created product in storage
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Product  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request, Product $model)
    {
        $model->create($request->all());

        return redirect()->route('product.index')->withStatus(__('Product successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('product.view', compact('product'));
    }

    /**
     * Show the form for editing the specified product
     *
     * @param  \App\Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified product in storage
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return mixed
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('product.index')->withStatus(__('Product successfully updated.'));
    }

    /**
     * Remove the specified product from storage
     *
     * @param Product $product
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->withStatus(__('Product successfully deleted.'));
    }
}
