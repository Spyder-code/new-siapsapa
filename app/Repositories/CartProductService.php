<?php

namespace App\Repositories;

use App\Models\CartProduct;

class CartProductService extends Repository
{

    public function __construct()
    {
        $this->model = new CartProduct;
    }
}