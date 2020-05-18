@extends('layouts.app')

@section('title', '| Process Order')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-12">
            <h3>Order:</h3>
            <hr>
        </div>
    </div> 
    @if( $products )  
    @foreach( $products as $product )
        <div class="row justify-content-center">
            <div class="col-md-3">
                <strong>Product Name:</strong><p>{{ $product->name }}</p>
            </div>    
            <div class="col-md-3">
                <strong>Product Manufacturer:</strong><p>{{ $product->manufacturer }}</p>
            </div>
            <div class="col-md-3">
                <strong>Product Price:</strong><p>{{ $product->price }}$</p>
            </div>
            <div class="col-md-3">
                @php
                    $productID = $product->id;
                @endphp
                <a href="javascript:void(0)" class="btn btn-outline-primary" data-price="{{ $product->price }}" id="{{ $product->id }}" onclick='removeProductFromCart("{{ $product->id }}", this)'>{{ __('remove from cart') }}</a>
            </div>    
        </div>
        <hr>
    @endforeach
    @else
        <div class="row justify-content-center"> 
            <div class="col-12">
                <h5>No Orders.</h5>
            </div>
        </div>
    @endif   
    <div class="row justify-content-center"> 
        <div class="col-12">
            <p>Total: <strong id="cart-total">{{ $total }}$</strong></p>
        </div>
        <div class="col-12">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('shop') }}">{{ __('BACK TO SHOP') }}</a>
            <a class="btn btn-outline-danger btn-sm" href="{{ route('clear.cart') }}">{{ __('CLEAR CART') }}</a>
        </div>
    </div>              
</div>
<input type="hidden" name="productList" id="product-list" value="">
@endsection