<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'quantity',
        'start_date',
        'end_date',
        'type_discount',
        'amount'
    ];

       public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'voucher_id', 'id' );
    }
}
