<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;

use App\Services\PaymentService;

use App\Models\Payment;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct() {
        $this->paymentService = new PaymentService();
    }

    public function index() {

        $this->authorize('viewAny', Payment::class);

        return PaymentResource::collection(Payment::simplePaginate(config('app.paginate')));
    }

    public function show(Payment $payment) {

        $this->authorize('view', Payment::class);

        return new PaymentResource($payment);
    }

    public function pay(StorePaymentRequest $request) {

        $this->authorize('pay', Payment::class);

        $payment = $this->paymentService->createPay($request->order_id);

        if($payment->status == 1) {
            return response()
                ->json(['success' => true]);
        }

    }
}
