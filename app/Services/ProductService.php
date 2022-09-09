<?php

namespace App\Services;

use App\Models\Feature;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductFeature;
use App\Models\ProductMemory;
use App\Repositories\ProductRepository;

/**
 * Class ProductService.
 */
class ProductService
{

    public function create($params)
    {
        
        $productData = array(
           'category_id' => $params['category'],
           'vendor_id' => $params['vendor'],
           'brand_id' => $params['brands'],
           'name' => $params['phone_name'],
           'price' => $params['price'],
           'discount' => $params['discount'],
           'active' => $params['active'],
           'quantity' => $params['quantity'],
           'battery' => $params['battery'],
           'short_description' => $params['short_description'],
           'description' => $params['description'],
           'os' => $params['os'] ,
           'year' => $params['year'],
           'cpu' => $params['chip'],
           'display_tech' => $params['screen'],
           'size' => $params['size'],
           'resolution' => $params['resolution'],
           'font_cam' => $params['front'],
           'rear_cam' => $params['rear'],
           'ram' => $params['ram'],
           'screen_rate' => $params['rate']
        );
        $product = Product::create($productData);
        
        foreach($params['features'] as $feature){
        $featureData = array(
             'product_id' => $product->id,
             'feature_id' => $feature
        );
        ProductFeature::create($featureData);
        }

        $memoryData = array(
            'product_id' => $product->id,
            'memory_id'=> $params['rom']
        );
        
        ProductMemory::create($memoryData);

        //Insert cover image
        $coverImageData = array(
            'product_id' => $product->id,
            'type' => 'cover',
            'url' => $params['thumb']
        ); 

        Image::create($coverImageData);

        //Insert Gallery Image
        $galleries = json_decode($params['thumbs']);
        foreach($galleries as $gallery){
        $galleryImageData = array(
            'product_id' => $product->id,
            'type' => 'gallery',
            'url' => $gallery
        ); 
        Image::create($galleryImageData);
        }

        //Insert colors for product
        foreach($params['colors'] as $color) {
             $colorData = array(
                'product_id' => $product->id,
                'color_id' => $color
             );

             ProductColor::create($colorData);
        } 
    }

    public function getProductsNewly()
    {
         $products = Product::where('active' ,1)
         ->orderBy('created_at', 'DESC')
         ->limit(5)
         ->get();

         return $products;
    }

    public function getProductsDiscount()
    {
        $products = Product::where('active', 1)
        ->orderBy('discount', 'DESC')
        ->limit(10)
        ->get();
     
        return $products;
    }

    public function getAllProducts()
    {
        $products = Product::where('active',1)
        ->orderBy('id', 'DESC')
        ->get();

        return $products;
    }

    public function getProductDetail(int $id)
    {
         return Product::where('active',1)
         ->where('id', $id)
         ->first();
  
    }
}
