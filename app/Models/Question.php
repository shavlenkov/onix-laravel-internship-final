<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'text',
    ];

    public function scopeSearchByProductId($query, ?int $id) {
        if(empty($id)) {
            return $query;
        }

        return $query->whereHas('product', function($q) use ($id) {
            $q->where('id', $id);
        });
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers() {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
