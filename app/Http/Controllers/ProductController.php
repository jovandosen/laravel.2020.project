<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Log;
use Auth;
use Gate;
use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller
{
	/**
	 * Create new Product instance
	 *
	 * @return void
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Show form for creating new Product
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	Gate::authorize('create-product');
    	return View::make('product.product');
    }

    /**
     * Store a newly created Product
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
    	$userID = $request->input('userID');
    	$productName = $request->input('name');
    	$productManufacturer = $request->input('manufacturer');
    	$productPrice = $request->input('price');
    	$productQuantity = $request->input('quantity');
    	$productDescription = $request->input('description');
    	$productImages = $request->file('images');

    	$userID = (int) $userID;
    	$productPrice = (int) $productPrice;
    	$productQuantity = (int) $productQuantity;

    	if( !empty($productImages) ){
    		// store images
    	} else {
    		$productImages = '';
    	}

    	$product = Product::create([
    		'user_id' => $userID,
    		'name' => $productName,
    		'manufacturer' => $productManufacturer,
    		'price' => $productPrice,
    		'quantity' => $productQuantity,
    		'description' => $productDescription,
    		'images' => $productImages
    	]);

    	if( $product ){
    		Log::info('New Product Created.');
    		$request->session()->flash('productCreated', 'You have successfully created Product.');
    		return redirect()->route('product.show');
    	}

    }
}
