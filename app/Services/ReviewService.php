<?php


namespace App\Services;

use App\Http\Resources\ReviewResource;
use App\Models\Review;

class ReviewService
{
    public function getReviews(?int $product_id)
    {
        return ReviewResource::collection(
            Review::searchByProductId($product_id)->simplePaginate(config('app.paginate'))
        );
    }

    public function createReview(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        $review = Review::create($data);
    }

    public function updateReview(array $data, Review $review)
    {
        [
            'text' => $text,
            'rating' => $rating
        ] = $data;

        $review->text = $text;
        $review->rating = $rating;

        $review->save();
    }
}
