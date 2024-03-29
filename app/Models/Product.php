<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\FuncCall;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'vendor_id', 'brand_id', 'price', 'discount', 'short_description', 'description', 'active', 'year', 'quantity', 'battery', 'os', 'cpu', 'core', 'speed', 'size', 'display_tech', 'resolution', 'font_cam', 'rear_cam', 'ram', 'screen_rate', 'color', 'rom'];

    public function productCategory()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, foreignKey: 'product_id', localKey: 'id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'product_features', 'product_id', 'feature_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, foreignKey: 'product_id', localKey: 'id');
    }
    public function scopeBrand(Builder $query, string $branchId): Builder
    {
        $branchId = explode('-', $branchId);

        return $query->whereIn('brand_id', $branchId);
    }



    public function scopeRom(Builder $query, string $romId): Builder
    {
        $romId = explode('-', $romId);

        return $query->whereIn('rom', $romId);
    }

    public function scopeOs(Builder $query, string $osId): Builder
    {
        $osId = explode('-', $osId);

        return $query->whereIn('os', $osId);
    }

    public function scopePrice(Builder $query, string $price): Builder
    {
        $price = explode('-', $price);
        $price = array_map(function ($item) {
            return (object) [
                'minPrice' => explode(';', $item)[0],
                'maxPrice' => explode(';', $item)[1],
            ];
        }, $price);

        //write query for $query with price between minPrice and maxPrice
        $query->whereBetween('price', [$price[0]->minPrice, $price[0]->maxPrice]);
        //check if price has second value, loop and add orWhereBetween value
        if (count($price) > 1) {
            for ($i = 1; $i < count($price); $i++) {
                $query->orWhereBetween('price', [$price[$i]->minPrice, $price[$i]->maxPrice]);
            }
        }

        return $query;
    }

    public function scopeCategory(Builder $query, string $categoryId): Builder
    {
        $categoryId = explode('-', $categoryId);

        return $query->whereIn('category_id', $categoryId);
    }

}
