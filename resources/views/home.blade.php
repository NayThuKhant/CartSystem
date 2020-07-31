@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    @livewire('products')
                </div>
            </div>
        </div>
         <div class="col-md-3">
            <div class="card">
                <div class="card-header">Shopping Cart</div>

                <div class="card-body">
                    @livewire('cart')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
