<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Image;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Brand;
use Exception;

/**
 * Class ProductService.
 */
class BrandService
{
    public function store(array $params)
    {
        try {
            $data = [
                'name' => $params['name'],
                'image' => $params['image'],
                'description' => $params['description'],
                'country' => $params['country'],
                'active' => $params['active'],
            ];

            Brand::create($data);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function update(array $params, Brand $brand)
    {
        try {
            $data = [
                'name' => $params['name'],
                'image' => $params['image'],
                'description' => $params['description'],
                'country' => $params['country'],
                'active' => $params['active'],
            ];



            if ($params['file'] != null) {
                $data['image'] = $params['image'];
            }
            $brand->update($params);
            Product::where('brand_id', $brand->id)->update(array('active' => $params['active']));
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
