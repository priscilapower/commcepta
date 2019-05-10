<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRequest;
use App\Seller;

class SellerController extends Controller
{
    /**
     * Display a listing of the sellers
     *
     * @param  \App\Seller  $model
     * @return \Illuminate\View\View
     */
    public function index(Seller $model)
    {
        return view('seller.index', ['sellers' => $model->paginate(10)]);
    }

    /**
     * Show the form for creating a new seller
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('seller.create');
    }

    /**
     * Store a newly created seller in storage
     *
     * @param  \App\Http\Requests\SellerRequest  $request
     * @param  \App\Seller  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SellerRequest $request, Seller $model)
    {
        $model->create($request->all());

        return redirect()->route('seller.index')->withStatus(__('Seller successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller $seller
     * @return \Illuminate\View\View
     */
    public function show(Seller $seller)
    {
        return view('seller.view', compact('seller'));
    }

    /**
     * Show the form for editing the specified seller
     *
     * @param  \App\Seller $seller
     * @return \Illuminate\View\View
     */
    public function edit(Seller $seller)
    {
        return view('seller.edit', compact('seller'));
    }

    /**
     * Update the specified seller in storage
     *
     * @param SellerRequest $request
     * @param Seller $seller
     * @return mixed
     */
    public function update(SellerRequest $request, Seller $seller)
    {
        $seller->update($request->all());

        return redirect()->route('seller.index')->withStatus(__('Seller successfully updated.'));
    }

    /**
     * Remove the specified seller from storage
     *
     * @param Seller $seller
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();

        return redirect()->route('seller.index')->withStatus(__('Seller successfully deleted.'));
    }
}
