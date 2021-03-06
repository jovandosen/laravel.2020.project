<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;
use App\Mail\ProductRecordCreated;
use Mail;
use Auth;

class LogProductInformation
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
     * @param  ProductCreated  $event
     * @return void
     */
    public function handle(ProductCreated $event)
    {
        $productName = $event->product->name;
        Log::info("New Product: $productName created and stored in database.");
        $userEmail = Auth::user()->email;
        Mail::to($userEmail)->send(new ProductRecordCreated($event->product));
    }
}
