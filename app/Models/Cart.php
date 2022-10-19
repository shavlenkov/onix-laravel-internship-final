<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Scopes\MyCartScope;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'quantity'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected static function booted() {
        static::addGlobalScope(new MyCartScope);
    }

}
