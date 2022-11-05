<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return CategoryResource::collection(Category::simplePaginate(config('app.paginate')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     * @return mixed
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        $data = $request->validated();

        $category = Category::create($data);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     * @param Category $category
     * @return mixed
     */
    public function update(StoreUpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $this->categoryService->updateCategory($data, $category);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return mixed
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()
            ->json(['success' => true]);
    }
}
