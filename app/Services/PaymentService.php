<?php


namespace App\Services;

use App\Models\Payment;
use App\Models\Order;

use App\Events\OrderStatusUpdated;

class PaymentService
{
    public function createPay(int $order_id) {

        $order = Order::findOrFail($order_id);

        $price = $order->item->price * 100;

        $user = auth()->user();

        $user->createOrGetStripeCustomer();

        $stripeCharge = $user->charge(
            $price, config('app.payment_id')
        );

        $payment = Payment::create([
            'payment_method' => 'stripe',
            'user_id' => $user->id,
            'order_id' => $order->id,
            'status' => $stripeCharge->status == 'succeeded' ? 1 : 0,
        ]);

        if($payment->status == 1) {
            $order->item->product->decrement('in_stock', $order->item->quantity);

            $order->update([
                'status' => 1
            ]);

            event(new OrderStatusUpdated($order));
        }

        return $payment;

    }
}
