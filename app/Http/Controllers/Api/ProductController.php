<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\QuestionResource;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
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
        return ProductResource::collection(Product::searchByCategoryIds($request->query('category_ids'))->simplePaginate(config('app.paginate')));
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

        $product = Product::create($data);

        if(!empty($data['image'])) {
            $image = $data['image'];
            $path = $image->store('images');

            $product->image()->create([
                'filename' => $path,
            ]);
        }

        $category = Category::find($data['category_ids']);

        $product->categories()->attach($category);

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

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->in_stock = $data['in_stock'];

        $product->save();

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
