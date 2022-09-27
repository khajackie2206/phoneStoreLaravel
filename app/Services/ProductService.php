<?php

namespace App\Services;

use App\Models\Feature;
use Illuminate\Support\Facades\Log;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductFeature;
use App\Models\ProductMemory;
use App\Repositories\ProductRepository;
use Exception;
/**
 * Class ProductService.
 */
class ProductService
{

    public function create($params)
    {
        try{
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
    } catch (Exception $err)
    {
         Log::info($err->getMessage());

        return false;
    }

    return true;
    }

    public function getProductsNewly()
    {
         $products = Product::where('active' ,1)
         ->orderBy('created_at', 'DESC')
         ->limit(10)
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

    public function updateProduct(array $params, Product $product)
    {
        try{
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
       
        $product->update($productData);

         //update product feature

        ProductFeature::where('product_id', $product->id)->delete();
        foreach($params['features'] as $feature){
        $featureData = array(
             'product_id' => $product->id,
             'feature_id' => $feature
        );
        ProductFeature::create($featureData);
        }

        // Update memory
        ProductMemory::where('product_id', $product->id)->delete();

          $memoryData = array(
            'product_id' => $product->id,
            'memory_id'=> $params['rom']
        );
        
        ProductMemory::create($memoryData);

         //Update cover image
        if($params['file'] != null){
        Image::where('product_id', $product->id)->where('type', 'cover')->delete();
        $coverImageData = array(
            'product_id' => $product->id,
            'type' => 'cover',
            'url' => $params['thumb']
        ); 
        Image::create($coverImageData);

        }

         //Update Gallery Image
        if(count($params['files']) > 0){
        Image::where('product_id', $product->id)->where('type', 'gallery')->delete();
        $galleries = json_decode($params['thumbs']);

        foreach($galleries as $gallery){
        $galleryImageData = array(
            'product_id' => $product->id,
            'type' => 'gallery',
            'url' => $gallery
        ); 
        Image::create($galleryImageData);
            }
        }

        //Update colors of product
        ProductColor::where('product_id', $product->id)->delete();
        foreach($params['colors'] as $color) {
             $colorData = array(
                'product_id' => $product->id,
                'color_id' => $color
             );

             ProductColor::create($colorData);
        } 
        
     } catch (Exception $err) 
     {
        Log::info($err->getMessage());

        return false;
     }  

     return true;
    }
}
