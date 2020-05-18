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
            @if(!empty(session('productIds')))
                <a class="btn btn-outline-danger btn-sm" href="{{ route('clear.cart') }}">{{ __('CLEAR CART') }}</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#orderModal">{{ __('ORDER PRODUCTS') }}</a>
            @endif
        </div>
    </div>              
</div>
<input type="hidden" name="productList" id="product-list" value="">
<input type="hidden" name="processOrder" id="process-order" value="order">

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are You sure You want to order these Products ?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success" data-send="" id="confirm-yes" onclick="processUserOrder()">Yes</button>
            </div>
        </div>
    </div>
</div>

@endsection