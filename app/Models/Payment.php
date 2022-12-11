<?php

namespace App\Models;

use App\Scopes\MyPaymentsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'payment_method',
        'user_id',
        'order_id',
        'status'
    ];

    protected static function booted()
    {
        if(auth()->user()->status == 0) {
            static::addGlobalScope(new MyPaymentsScope);
        }
    }
}
