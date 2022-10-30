<?php

namespace App\Models;

use App\Scopes\MyReviewsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'text',
        'rating'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearchByProductId($query, ?int $id) {
        if(empty($id)) {
            return $query;
        }

        return $query->where('id', $id);
    }

}
