<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'payment_id',
        'user_id',
        'order_date',
        'note',
        'total',
        'delivery_address',
        'voucher_id'
    ];
}
