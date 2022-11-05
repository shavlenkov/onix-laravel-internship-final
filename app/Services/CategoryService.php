<?php


namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function updateCategory(array $data, Category $category) {

        [
            'name' => $name
        ] = $data;

        $category->name = $name;
        $category->description = isset($data['description']) ? $data['description'] : null;

        $category->save();
    }
}
