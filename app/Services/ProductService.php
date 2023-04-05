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
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;

/**
 * Class ProductService.
 */
class ProductService
{
    const LIMIT = 6;

    public function create($params)
    {
        try {
            $productData = array(
                'category_id' => $params['category'],
                'brand_id' => $params['brands'],
                'name' => $params['phone_name'],
                'price' => $params['price'],
                'discount' => $params['discount'] ?? 0,
                'active' => $params['active'],
                'quantity' => 0 ,
                'battery' => $params['battery'],
                'short_description' => $params['short_description'],
                'description' => $params['description'],
                'os' => $params['os'],
                'year' => $params['year'],
                'cpu' => $params['chip'],
                'display_tech' => $params['screen'],
                'size' => $params['size'],
                'resolution' => $params['resolution'],
                'font_cam' => $params['front'],
                'rear_cam' => $params['rear'],
                'ram' => $params['ram'],
                'screen_rate' => $params['rate'],
                'color' => $params['color'],
                'rom' => $params['rom']
            );

            $product = Product::create($productData);

            foreach ($params['features'] as $feature) {
                $featureData = array(
                    'product_id' => $product->id,
                    'feature_id' => $feature
                );
                ProductFeature::create($featureData);
            }

            //Insert cover image
            $coverImageData = array(
                'product_id' => $product->id,
                'type' => 'cover',
                'url' => $params['thumb']
            );

            Image::create($coverImageData);

            //Insert Gallery Image
            $galleries = json_decode($params['thumbs']);
            foreach ($galleries as $gallery) {
                $galleryImageData = array(
                    'product_id' => $product->id,
                    'type' => 'gallery',
                    'url' => $gallery
                );
                Image::create($galleryImageData);
            }

            //insert activity
            $user = session()->get('user');
            $activityData = array(
                'staff_id' => $user->id,
                'action' => 'Thêm sản phẩm mới (Mã sản phẩm: #' . $product->id . ')'
            );

           $activityData = Activity::create($activityData);

        } catch (Exception $err) {
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function getProductsNewly()
    {
        $products = Product::where('active', 1)
            ->where('delete_at', null)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get()->unique('name');

        return $products;
    }

    public function getProductsDiscount()
    {
        $products = Product::distinct('name')->where('active', 1)
            ->where('delete_at', null)
            ->orderBy('discount', 'DESC')
            ->limit(10)
            ->get()->unique('name');

        return $products;
    }

    public function getAllProducts()
    {
        $products = Product::where('active', 1)
           ->where('delete_at', null)
            ->orderBy('id', 'DESC')
            ->limit(self::LIMIT)
            ->get()->unique('name');

        return $products;
    }

    public function getBestSellers()
    {
        $bestSellers = DB::table('order_details')
            ->select('product_id', DB::raw('sum(quantity) as total'))
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit(self::LIMIT)
            ->get();
        $products = [];
        foreach ($bestSellers as $bestSeller) {
            $product = Product::where('id', $bestSeller->product_id)
                ->first();
            array_push($products, $product);
        }

        return $products;
    }

    //get top products have highest rating in table comments
    public function getTopRatings()
    {
        $topProducts = DB::table('comments')
            ->select('product_id', DB::raw('avg(rating) as total'))
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit(self::LIMIT)
            ->get();
        $products = [];
        foreach ($topProducts as $topProduct) {
            $product = Product::where('id', $topProduct->product_id)
                ->first();
            array_push($products, $product);
        }

        return $products;
    }



    public function filterProduct($params){
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'name',
                AllowedFilter::scope('brand'),
                AllowedFilter::scope('rom'),
                AllowedFilter::scope('os'),
                AllowedFilter::scope('price'),
            ])
            ->allowedSorts(['name', 'price'])
            ->paginate(6)
            ->appends(request()->query());
        //get number of products
        $count = $products->total();

        return ['data'=>$products,'total'=>$count];
    }

    public function getSameBrands(Product $product)
    {
        $products = Product::where('id', '<>', $product->id)
             ->where('delete_at', null)
             ->where('brand_id', $product->brand_id)
             ->where('name','<>', $product->name)
             ->orderBy('id', 'DESC')
             ->get()->unique('name');

        return $products;
    }


    public function getProductDetail(int $id)
    {
        return Product::where('id', $id)
            ->first();
    }

    public function updateProduct(array $params, Product $product)
    {
        try {
            $productData = array(
                'category_id' => $params['category'],
                'vendor_id' => $params['vendor'],
                'brand_id' => $params['brands'],
                'name' => $params['phone_name'],
                'price' => $params['price'],
                'discount' => $params['discount'],
                'active' => $params['active'],
                'battery' => $params['battery'],
                'short_description' => $params['short_description'],
                'description' => $params['description'],
                'os' => $params['os'],
                'year' => $params['year'],
                'cpu' => $params['chip'],
                'display_tech' => $params['screen'],
                'size' => $params['size'],
                'resolution' => $params['resolution'],
                'font_cam' => $params['front'],
                'rear_cam' => $params['rear'],
                'ram' => $params['ram'],
                'screen_rate' => $params['rate'],
                'color' => $params['color'],
                'rom' => $params['rom']
            );

            $product->update($productData);

            //update product feature

            ProductFeature::where('product_id', $product->id)->delete();
            foreach ($params['features'] as $feature) {
                $featureData = array(
                    'product_id' => $product->id,
                    'feature_id' => $feature
                );
                ProductFeature::create($featureData);
            }

            //Update cover image
            if ($params['file'] != null) {
                Image::where('product_id', $product->id)->where('type', 'cover')->delete();
                $coverImageData = array(
                    'product_id' => $product->id,
                    'type' => 'cover',
                    'url' => $params['thumb']
                );
                Image::create($coverImageData);
            }

            //Update Gallery Image
            if (count($params['files']) > 0) {
                Image::where('product_id', $product->id)->where('type', 'gallery')->delete();
                $galleries = json_decode($params['thumbs']);

                foreach ($galleries as $gallery) {
                    $galleryImageData = array(
                        'product_id' => $product->id,
                        'type' => 'gallery',
                        'url' => $gallery
                    );
                    Image::create($galleryImageData);
                }
            }

        } catch (Exception $err) {
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }
    public function get($page = null)
    {
        return Product::orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get()->unique('name');
    }

    public function getGroupProduct(Product $product) {
        return Product::where('name', 'like', $product->name)->get();
    }

    public function getAllComments(Product $product)
    {
        return Product::where('', '');
    }
}
