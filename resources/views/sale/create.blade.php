@extends('layouts.app', ['title' => __('Sale Management')])

@section('content')
    @include('sale.partials.header', ['title' => __('Add Sale')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Sale Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sale.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sale.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Sale information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('products') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-products">{{ __('Products') }}</label>
                                    <select name="products[]" class="selectpicker form-control form-control-alternative{{ $errors->has('products') ? ' is-invalid' : '' }}" multiple data-live-search="true">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('products'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('products') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('seller') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-seller">{{ __('Seller') }}</label>
                                    <select name="id_seller" class="selectpicker form-control form-control-alternative{{ $errors->has('seller') ? ' is-invalid' : '' }}" data-live-search="true">
                                        @foreach($sellers as $seller)
                                            <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('seller'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('seller') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
