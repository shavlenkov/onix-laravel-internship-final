@component('mail::message')
# Order created

## Hello, {{ $order->user->name }}!
## Your order ID: {{ $order->id }}

## Order details:

@component('mail::table')

    |Product name    |Quantity                     |           Price          |
    |:---              |           :---:             |                     ----:|
    |{{$order->item->product->name}}|{{$order->item->quantity}}|{{$order->item->price}} $|

@endcomponent

@endcomponent

