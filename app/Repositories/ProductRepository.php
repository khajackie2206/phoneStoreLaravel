<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
       return Product::class;
    }
}
