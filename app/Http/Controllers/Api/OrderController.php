<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return OrderResource::collection(Order::simplePaginate(config('app.paginate')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return mixed
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $data['address'] = auth()->user()->address;
        $data['status'] = 0;

        $order = Order::create($data);

        $order->item()->create([
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'price' => Product::find($data['product_id'])->price * $data['quantity']
        ]);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return mixed
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();

        $order->comment = $data['comment'];

        $order->item()->update([
            'quantity' => $data['quantity'],
            'price' => $order->item->product->price * $data['quantity']
        ]);

        $order->save();

        return response()
            ->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return mixed
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()
            ->json(['success' => true]);
    }
}
