<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'status_id',
        'payment_id',
        'user_id',
        'order_date',
        'note',
        'total',
        'delivery_address',
        'voucher_id',
        'staff_id',
        'deleted_at'
    ];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class,'order_id', 'id' );
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }

    public function voucher(): HasOne
    {
        return $this->hasOne(Voucher::class, 'id', 'voucher_id');
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class,'id','staff_id');
    }

}
