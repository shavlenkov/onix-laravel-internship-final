<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'in_stock' => $this->resource->in_stock,
            'rating' => $this->resource->rating,
            'categories' => $this->resource->categories,
            'questions' => $this->resource->questions,
            'image' => $this->resource->image,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}
