<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'productName' => $this->product_name,
            'productPrice' => $this->product_price,
            'createdAt' => $this->created_at->toDayDateTimeString(),
            'updatedAt' => $this->updated_at->toDayDateTimeString(),
        ];
    }
}
