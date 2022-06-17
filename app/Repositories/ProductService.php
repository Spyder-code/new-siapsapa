<?php

namespace App\Repositories;

use App\Models\Product;

class ProductService extends Repository
{

    public function __construct()
    {
        $this->model = new Product;
    }
}
