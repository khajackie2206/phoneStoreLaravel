<?php

namespace App\Services;

use App\Models\Feature;
use Illuminate\Support\Facades\Log;
use App\Models\Image;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductFeature;
use App\Models\ProductMemory;
use App\Repositories\ProductRepository;
use Exception;

/**
 * Class ProductService.
 */
class BannerService
{
    public function store(array $params)
    {
        try {
            $data = [
                'header' => $params['header'],
                'product_name' => $params['product_name'],
                'price' => $params['price'],
                'thumb' => $params['thumb'],
                'url' => $params['url'],
                'type_banner' => $params['type_banner'],
                'sort_by' => $params['order'],
                'active' => $params['active'],
            ];

            Banner::create($data);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function update(array $params, Banner $banner)
    {
        try {
            $data = [
                'header' => $params['header'],
                'product_name' => $params['product_name'],
                'price' => $params['price'],
                'type_banner' => $params['type_banner'],
                'url' => $params['url'],
                'order' => $params['order'],
                'active' => $params['active'],
            ];

            if ($params['file'] != null) {
                $data['thumb'] = $params['thumb'];
            }

            $banner->update($params);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
