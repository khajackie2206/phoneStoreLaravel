<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseDetail extends Model
{
    use HasFactory;

    protected $table = 'warehouse_details';

    protected $fillable = [
        'product_id',
        'receipt_id',
        'quantity',
        'price',
        'created_at',
        'updated_at',
    ];
}
