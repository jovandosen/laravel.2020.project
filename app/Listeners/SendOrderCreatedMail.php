<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OrderRecordCreated;
use Mail;
use Auth;
use App\Product;

class SendOrderCreatedMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $userEmail = Auth::user()->email;

        $ids = $event->order->products;

        $ids = json_decode($ids);

        $productNames = [];

        $total = 0;

        foreach ($ids as $key => $value) {
            $product = Product::find($value);
            $productNames[] = $product->name;
            $total = $total + $product->price;
        }

        Mail::to($userEmail)->send(new OrderRecordCreated($event->order, $productNames, $total));
    }
}
