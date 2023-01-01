<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

use App\Events\OrderCreated;

class OrderService
{
    public function createOrder(array $data)
    {
        [
            'product_id' => $product_id,
            'comment' => $comment,
            'quantity' => $quantity,
        ] = $data;

        $data['user_id'] = auth()->user()->id;
        $data['address'] = auth()->user()->address;
        $data['status'] = 0;

        $order = Order::create($data);

        $order->item()->create([
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => Product::findOrFail($product_id)->price * $quantity
        ]);

        event(new OrderCreated($order));
    }

    public function updateOrder(array $data, Order $order)
    {
        [
            'comment' => $comment,
            'quantity' => $quantity
        ] = $data;

        $order->comment = $comment;

        $order->item()->update([
            'quantity' => $quantity,
            'price' => $order->item->product->price * $quantity,
        ]);

        $order->save();
    }
}
