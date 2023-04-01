<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WarehouseReceipt extends Model
{
    use HasFactory;

    protected $table = 'warehouse_receipts';

    protected $fillable = [
        'created_date',
        'confirm_date',
        'total',
        'staff_id',
        'supplier_id',
        'status',
        'note',
        'created_at',
        'updated_at'
    ];

     public function admin(): HasOne
    {
        return $this->hasOne(Admin::class,'id', 'staff_id');
    }
}
