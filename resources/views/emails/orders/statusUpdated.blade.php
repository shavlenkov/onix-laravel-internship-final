@component('mail::message')
# Order status updated

## Hello, {{ $order->user->name }}!

## Status of your order #{{ $order->id }} has been successfully updated to {{ $order->status }}

@endcomponent
