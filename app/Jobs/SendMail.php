<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $user;
    protected $products;
    protected $typeDiscount;
    protected $discount;
    protected $carts;
    protected $address;
    protected $summary;
    protected $paymentMethod;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $user, $products, $carts, $address, $discount = null, $summary, $paymentMethod, $typeDiscount)
    {
        $this->email = $email;
        $this->user = $user;
        $this->products = $products;
        $this->discount = $discount;
        $this->summary = $summary;
        $this->address = $address;
        $this->carts = $carts;
        $this->paymentMethod = $paymentMethod;
        $this->typeDiscount = $typeDiscount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new OrderMail($this->user, $this->products, $this->carts, $this->address, $this->discount, $this->summary, $this->paymentMethod, $this->typeDiscount, $this->typeDiscount));
    }
}
