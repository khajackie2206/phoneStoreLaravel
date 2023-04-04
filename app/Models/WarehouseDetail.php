<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

      public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

      public function warehouseReceipt(): BelongsTo
    {
        return $this->belongsTo(WarehouseReceipt::class, 'id', 'receipt_id');
    }
}
