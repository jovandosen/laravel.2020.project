<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;

class OrderRecordCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Order
     */
    public $order;

    /**
     * @var array $names
     */
    public $names;

    /**
     * @var int $total
     */
    public $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, array $names, $total)
    {
        $this->order = $order;
        $this->names = $names;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_created_template');
    }
}
