<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Banner extends Model
{
     use HasFactory;
     protected $fillable = [
        'id',
        'header',
        'product_name',
        'price',
        'url',
        'thumb',
        'sort_by',
        'type_banner',
        'active',
    ];
}
