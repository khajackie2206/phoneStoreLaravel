<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone'
    ];

    public function warehouseReceipts(): HasMany
    {
        return $this->hasMany(WarehouseReceipt::class, 'id', 'supplier_id');
    }
}
