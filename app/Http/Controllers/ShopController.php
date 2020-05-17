<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Product;
use DB;

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
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productList(Request $request)
    {

        $priceFrom = (int) $request->priceFrom;
        $priceTo = (int) $request->priceTo;
        $searchTerm = $request->search;

        if( is_null($searchTerm) ){
            $searchTerm = '';
        }

        if( $priceTo === 0 ){
            $priceTo = DB::table('products')->pluck('price')->max();
        }

        if( !empty( $searchTerm ) ){

            $products = DB::table('products')
                                    ->where('price', '>', $priceFrom)
                                    ->where('price', '<', $priceTo)
                                    ->where(function ($query) use ($searchTerm) {
                                        $query->where('name', 'like', "%$searchTerm%")
                                              ->orWhere('manufacturer', 'like', "%$searchTerm%")
                                              ->orWhere('description', 'like', "%$searchTerm%");
                                    })
                                    ->paginate(4);

        } elseif( isset($request->priceFrom) || isset($request->priceTo) ){

            $products = DB::table('products')
                                    ->where('price', '>', $priceFrom)
                                    ->where('price', '<', $priceTo)
                                    ->paginate(4);

        } else {
            $products = Product::paginate(12);
        }                            

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

        if( !empty( session('productItems') ) ){

            $ids = session('productItems');

            if( in_array($productID, $ids) ){
                $inCart = true;
            } else {
                $inCart = false;
            }

        }

    	return View::make('shop.product_details', ['product' => $product, 'productImages' => $productImages, 'inCart' => $inCart]);
    }

    /**
     * Display User Order
     *
     * @param  string  $data
     *
     * @return \Illuminate\Http\Response
     */
    public function processOrder($data = '')
    {
        if( empty($data) ){
            $ids = [];
        } else {
            $ids = explode(",", $data);
        }

        $products = [];

        $total = 0;

        if( $ids ){
            foreach ($ids as $key => $value) {
                $product = Product::find($value);
                $products[] = $product;
                $total = $total + $product->price;
            }
        }

        session(['productItems' => $ids]);
        session(['productItemsData' => $data]);

    	return view('shop.process_order', ['products' => $products, 'total' => $total, 'data' => $data]);
    }

    /**
     * Clear cart data
     *
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        session()->forget('productItems');
        session()->forget('productItemsData');
        return redirect()->route('shop');
    }

    /**
     * Test ajax 
     *
     * @return string
     */
    public function testAjax()
    {
        echo "Well and Good...";
    }
}
