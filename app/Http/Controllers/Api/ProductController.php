<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateProductRequest;

use App\Http\Resources\ProductResource;
use App\Http\Resources\QuestionResource;
use App\Models\Product;

use App\Services\ProductService;

class ProductController extends Controller
{

    protected $productService;

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->productService = new ProductService();
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->productService->getProducts($request->query('category_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateProductRequest $request
     * @return mixed
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $data = $request->validated();

        $this->productService->createProduct($data);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateProductRequest $request
     * @param Product $product
     * @return mixed
     */
    public function update(StoreUpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $this->productService->updateProduct($data, $product);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return mixed
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()
            ->json(['success' => true]);
    }


    public function getQuestions(Product $product)
    {
        $this->authorize('viewAny', Question::class);

        return QuestionResource::collection($product->questions);
    }
}
