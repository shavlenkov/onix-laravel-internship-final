<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

use App\Services\OrderService;

class OrderController extends Controller
{

    protected $orderService;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->orderService = new OrderService();
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

        $this->orderService->createOrder($data);

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

        $this->orderService->updateOrder($data, $order);

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
