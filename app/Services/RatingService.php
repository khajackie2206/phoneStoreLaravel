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
use App\Models\Comment;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Class ProductService.
 */
class RatingService
{
    public function add(array $params)
    {
        try {
            DB::beginTransaction();
            $data = [
                'user_id' => $params['user_id'],
                'product_id' => $params['product_id'],
                'comment' => $params['comment'],
                'rating' => $params['star-rating'],
                'status' => 0
            ];

            Comment::create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
        return true;
    }
}
