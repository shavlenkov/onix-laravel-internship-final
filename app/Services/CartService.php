<?php


namespace App\Services;

use App\Models\Cart;

class CartService
{
    public function addProductToCart(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        $cart = Cart::create($data);
    }
}
