<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Scopes\MyOrdersScope;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'status',
        'comment',
        'address'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item() {
        return $this->hasOne(OrderItem::class, 'order_id');
    }

    protected static function booted()
    {
        if(auth()->user()->status == 0) {
            static::addGlobalScope(new MyOrdersScope);
        }
    }

}
