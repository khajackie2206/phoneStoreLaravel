<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatus extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $user;
    protected $order;
    protected $status;
    protected $voucher;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = '';
        $view = '';

        //switch case status
        switch ($this->status) {
            case 2:
                $subject = 'Đơn hàng của bạn đã được xác nhận';
                $view = 'mail.confirm-order';
                break;
            case 3:
                $subject = 'Đơn hàng của bạn đang được vận chuyển';
                $view = 'mail.delivery-order';
                break;
            case 4:
                $subject = 'Đơn hàng của bạn đã được giao thành công';
                $view = 'mail.discount-voucher';
                break;
            default:
                $subject = 'Đơn hàng của bạn đã bị hủy';
                $view = 'mail.cancel-order';
                break;
        }

        return $this->subject($subject)->view($view, [
            'user' => $this->user,
            'order' => $this->order,
            'voucher' => $this->voucher,
        ]);
    }
}
