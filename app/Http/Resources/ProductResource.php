<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'model_number' => $this->model_number,
            'short_description' => $this->short_description,
            'warranty' => $this->warranty,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'product_link' => $this->product_link,
            'type' => $this->type->name,
            'media_id' => $this->media_id,
            'media_url' => $this->media_url,
            'brand' => $this->whenLoaded('brand', function () {
                return $this->brand ? [

                    'id' => $this->brand->id,
                    'name' => $this->brand->name,
                    'link' => $this->brand->link,
                    'logo_url' => $this->brand->logo_url
                ] : null;
            }),

            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
