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

    		$dir = mkdir( public_path("/images/products/$productName") );

    		$productImgList = [];

    		foreach( $productImages as $image ){
    			if( $image->isValid() ){
    				$imageName = $image->getClientOriginalName();
    				$imageExtension = $image->extension();
    				$imagePath = $image->path();

    				if( file_exists( public_path("/images/products/$productName/" . $imageName) ) ){

    					$random = rand(1, 10000);
                    	$imgName = pathinfo($imageName, PATHINFO_FILENAME);
                    	$img = $imgName . $random . '.' . $imageExtension;

                    	$storeImage = $image->move( public_path("/images/products/$productName/"), $img );
                    	$productImgList[] = $img;

    				} else {
    					$storeImage = $image->move( public_path("/images/products/$productName/"), $imageName );
    					$productImgList[] = $imageName;
    				}
    			}
    		}

    		$productImages = serialize($productImgList);

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

    /**
     * Display Product List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::all();
    	return View::make('product.products', ['products' => $products]);
    }

    /**
     * Delete Product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    	$productID = (int) $id;

    	$product = Product::find($productID);

    	$productDir = $product->name;

    	Gate::authorize('delete-product', $product);

    	$imagesToDelete = glob( public_path("/images/products/$productDir/") . "*.*" );

    	foreach ($imagesToDelete as $key => $value) {
    		unlink($value);
    	}

    	$product->delete();

    	if( file_exists( public_path("/images/products/$productDir") ) ){
    		rmdir( public_path("/images/products/$productDir") );
    	}

    	$request->session()->flash('productDeleted', 'You have successfully deleted Product.');

        return redirect()->route('product.list');
    }
}
