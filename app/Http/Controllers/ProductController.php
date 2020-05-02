<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Log;
use Auth;

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
    	return View::make('product.product');
    }

    /**
     * Store a newly created Product
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$validatedData = $request->validate([
    		'name' => "required|string|max:255|unique:products",
    		'manufacturer' => "required|max:255|string",
    		'price' => "required|integer|min:1",
    		'quantity' => "required|integer|min:0"
    	]);
    }
}
