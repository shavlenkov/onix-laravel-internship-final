<?php


namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;

class ProductService
{
    public function getProducts(?string $category_ids)
    {
        return ProductResource::collection(
            Product::searchByCategoryIds($category_ids)
                ->sortByRating()
                ->simplePaginate(config('app.paginate')));
    }

    public function createProduct(array $data)
    {

        $product = Product::create($data);

        if(!empty($data['image'])) {
            $image = $data['image'];

            $path = $image->store('images');

            $product->image()->create([
                'filename' => $path,
            ]);
        } else {
            $product->image()->create([
                'filename' => null,
            ]);
        }

        $category = Category::find($data['category_ids']);

        $product->categories()->attach($category);
    }

    public function updateProduct(array $data, Product $product)
    {
        [
            'name' => $name,
            'in_stock' => $in_stock,
            'price' => $price,
            'category_ids' => $category_ids
        ] = $data;

        $product->name = $name;
        $product->description = isset($data['description']) ? $data['description'] : null;
        $product->in_stock = $in_stock;
        $product->price = $price;

        if(!empty($data['image'])) {
            $image = $data['image'];

            $path = $image->store('images');

            $product->image()->update([
                'filename' => $path,
            ]);
        } else {
            $product->image()->update([
                'filename' => null,
            ]);
        }

        $category = Category::find($category_ids);

        $product->categories()->sync($category);

        $product->save();
    }

}
