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
            'type' => $this->whenLoaded('type', function () {
                return [
                    'id' => $this->type->id,
                    'name' => $this->type->name,
                    'slug' => $this->type->slug,
                ];
            }),
            'media_url' => $this->whenLoaded("media", function ($media) {
                return $media->url;
            }),
            'brand' => $this->whenLoaded('brand', function ($brand) {
                return $brand ? [

                    'id' => $brand->id,
                    'name' => $brand->name,
                    'link' => $brand->link,
                    'media_url' => isset($brand['logo']) ? $brand['logo']['url'] : null,
                ] : null;
            }),

            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
