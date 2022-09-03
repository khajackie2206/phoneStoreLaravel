<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMemory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'memory_id'
    ];

}
