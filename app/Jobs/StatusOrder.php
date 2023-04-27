<?php

namespace App\Jobs;

use App\Mail\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class StatusOrder implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $order;
    protected $user;
    protected $status;
    protected $voucher;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $order, $status, $voucher = null)
    {
        $this->user = $user;
        $this->order = $order;
        $this->status = $status;
        $this->voucher = $voucher;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new OrderStatus($this->user, $this->order, $this->status, $this->voucher));
    }
}
