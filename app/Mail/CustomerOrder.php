<?php

namespace App\Mail;

use App\Models\Order;
use App\Services\OrderServices;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerOrder extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    protected $orderServices;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Đơn hàng online')
            ->view('emails._customer_order')
            ->with([
                'order' => $this->order
            ]);
    }
}
