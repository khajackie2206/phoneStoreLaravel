<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Product extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'category_id',
        'vendor_id',
        'brand_id',
        'price',
        'discount',
        'description',
        'active',
        'year',
        'quantity',
        'battery',
        'os',
        'cpu',
        'core',
        'speed',
        'size',
        'display_tech',
        'resolution',
        'font_cam',
        'rear_cam',
        'ram',
        'screen_rate'
    ];
     public function productCategory()
    {
        return $this->hasOne(ProductCategory::class,'id','category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    
    public function images(){
         return $this->hasMany(Image::class, foreignKey:'product_id',localKey:'id');
    }


    public function colors() {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id')->withTimestamps();
    }

    public function memories() {
         return $this->belongsToMany(Memory::class, 'products_memory', 'product_id', 'memory_id')->withTimestamps();
    }

     public function features() {
         return $this->belongsToMany(Feature::class, 'products_features', 'product_id', 'feature_id')->withTimestamps();
    }
}
