<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product_id"=>$this->id,
            "name"=>$this->name,
            "description"=>$this->description,
            "product_price"=>$this->price,
            "product_quantity"=>$this->quantity,
            "product_category"=>$this->category->name,
            "product_image"=>asset("storage") . "/". $this->image,
        ];
    }
}
