<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function warehouseDetails(): HasMany
    {
        return $this->hasMany(WarehouseDetail::class,'receipt_id', 'id' );
    }

    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
}
