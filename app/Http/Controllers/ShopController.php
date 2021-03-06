<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Product;
use DB;
use App\User;
use App\Order;
use Auth;
use App\Events\OrderCreated;

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

        if( !empty( session('productIds') ) ){

            $ids = session('productIds');

            if( in_array($productID, $ids) ){
                $inCart = true;
            } else {
                $inCart = false;
            }

        } else {
            $inCart = false;
        }

    	return View::make('shop.product_details', ['product' => $product, 'productImages' => $productImages, 'inCart' => $inCart]);
    }

    /**
     * Display User Order
     *
     * @return \Illuminate\Http\Response
     */
    public function processOrder()
    {
        $products = [];

        $total = 0;

        if( !empty( session('productIds') ) ){

            $ids = session('productIds');

            if( $ids ){
                foreach ($ids as $key => $value) {
                    $product = Product::find($value);
                    $products[] = $product;
                    $total = $total + $product->price;
                }
            }

        }

        return view('shop.process_order', ['products' => $products, 'total' => $total]);
    }

    /**
     * Clear cart data
     *
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        session()->forget('productIds');
        return redirect()->route('shop');
    }

    /**
     * Add product to cart
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     */
    public function cartAdd(Request $request)
    {
        $productID = (int) $request->productID;
        
        if( !empty( session('productIds') ) ){
            $ids = session('productIds');
            $ids[] = $productID;
            session(['productIds' => $ids]);
        } else {
            $ids = [];
            $ids[] = $productID;
            session(['productIds' => $ids]);
        }

    }

    /**
     * Remove product from cart
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     */
    public function cartRemove(Request $request)
    {
        $productID = (int) $request->productID;

        if( !empty( session('productIds') ) ){

            $ids = session('productIds');

            $itemIds = [];

            foreach ($ids as $key => $value) {
                if( $productID !== $value ){
                    $itemIds[] = $value;
                }
            }

            session(['productIds' => $itemIds]);
        } 
    }

    /**
     * Process User Order
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function processUserOrder(Request $request)
    {
        $userID = Auth::user()->id;

        if( !empty( session('productIds') ) ){
            $ids = session('productIds');
        } else {
            $ids = [];
        }

        $ids = json_encode($ids);

        $order = Order::create([
            'user_id' => $userID,
            'products' => $ids
        ]);

        if( $order ){
            event(new OrderCreated($order));
            $request->session()->flash('orderCreated', 'You have successfully ordered Products.');
            session()->forget('productIds');
            return redirect()->route('shop');
        }
    }

    /**
     * Display User Orders
     *
     * @return \Illuminate\Http\Response
     */
    public function viewOrders()
    {
        $orders = Auth::user()->orders;

        $results = [];

        foreach ($orders as $key => $order) {

            $products = [];

            $ids = json_decode($order->products);
            
            for( $i = 0; $i < count($ids); $i++ ){

                $product = Product::find($ids[$i]);

                $products[] = $product;

                if( ( $i + 1 ) === count($ids) ){
                    $results[] = $products;
                    break;
                }    

            }

        }

        $allOrders = $results;

        return View::make('shop.view_orders', ['allOrders' => $allOrders]);
    }
}
