<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;

use App\Services\ReviewService;

class ReviewController extends Controller
{

    protected $reviewService;

    /**
     * ReviewController constructor.
     */
    public function __construct()
    {
        $this->reviewService = new ReviewService();
        $this->authorizeResource(Review::class, 'review');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return $this->reviewService->getReviews($request->query('product_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReviewRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();

        $this->reviewService->createReview($data);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param Review $review
     * @return ReviewResource
     */
    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReviewRequest $request
     * @param Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $data = $request->validated();

        $this->reviewService->updateReview($data, $review);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response()
            ->json(['success' => true]);
    }
}
