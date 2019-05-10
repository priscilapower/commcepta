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
        try {
            $model->create($request->all());

            return redirect()->route('product.index')->withStatus(__('Product successfully created.'));
        } catch (\Exception $exception) {
            return redirect()->route('product.index')->withError(__('An error has occurred.'));
        }
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
        try {
            $product->update($request->all());

            return redirect()->route('product.index')->withStatus(__('Product successfully updated.'));
        } catch (\Exception $exception) {
            return redirect()->route('product.index')->withError(__('An error has occurred.'));
        }
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
        try {
            $product->delete();

            return redirect()->route('product.index')->withStatus(__('Product successfully deleted.'));
        } catch (\Exception $exception) {
            return redirect()->route('product.index')->withError(__('An error has occurred.'));
        }
    }
}
