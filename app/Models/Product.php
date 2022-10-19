<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'in_stock',
        'price',
        'rating'
    ];

    public function scopeSearchByCategoryIds($query, ?string $category_ids) {
        if(empty($category_ids)) {
            return $query;
        }

        return $query->whereHas('categories', function($q) use ($category_ids) {
            $q->whereIn('id', explode(',', $category_ids));
        });
    }

    public function image() {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function questions() {
        return $this->hasMany(Question::class, 'product_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

}
