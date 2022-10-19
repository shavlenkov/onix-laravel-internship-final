<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\CartResource;
use App\Http\Requests\StoreCartRequest;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Cart::class);

        return CartResource::collection(Cart::simplePaginate(config('app.paginate')));
    }

    public function store(StoreCartRequest $request)
    {
        $this->authorize('create', Cart::class);

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $cart = Cart::create($data);

        return response()
            ->json(['success' => true]);
    }

    public function deleteAll()
    {
        $this->authorize('delete', Cart::class);

        Cart::query()->delete();

        return response()
            ->json(['success' => true]);
    }

    public function deleteOne(Cart $cart)
    {
        $this->authorize('delete', $cart);

        $cart->delete();

        return response()
            ->json(['success' => true]);
    }
}
