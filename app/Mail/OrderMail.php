<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $products;
    protected $discount;
    protected $summary;
    protected $carts;
    protected $address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $products, $carts, $address, $discount, $summary)
    {
        $this->user = $user;
        $this->products = $products;
        $this->discount = $discount;
        $this->summary = $summary;
        $this->carts = $carts;
        $this->address = $address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order', [
            'user' => $this->user,
            'products' => $this->products,
            'discount' => $this->discount,
            'summary' => $this->summary,
            'carts' => $this->carts,
            'address' => $this->address
        ]);
    }
}
