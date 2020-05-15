<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Product;

class ShopController extends Controller
{
	/**
	 * Create new Shop instance
	 *
	 * @return void
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Display Product List
     *
     * @return \Illuminate\Http\Response
     */
    public function productList()
    {
    	$products = Product::all();
    	return View::make('shop.product_list', ['products' => $products]);
    }

    /**
     * Display Product Details
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function productDetails($id)
    {
    	$productID = (int) $id;

    	$product = Product::find($productID);

    	if( !empty($product->images) ){
            $productImages = unserialize($product->images);
        } else {
            $productImages = [];
        }

    	return View::make('shop.product_details', ['product' => $product, 'productImages' => $productImages]);
    }

    /**
     * Display User Order
     *
     * @param  string  $data
     *
     * @return \Illuminate\Http\Response
     */
    public function processOrder($data)
    {
    	var_dump($data);
    }
}
