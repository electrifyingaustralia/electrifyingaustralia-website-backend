<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
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
            'product_link' => $this->product_link,
            'type' => $this->type->name,

            // Media
            'media' => $this->whenLoaded('media', function () {
                return [
                    'media_url' => getAssetFileUrl("media", $this->media->file_name, disk: $this->media->disk),
                    'alt_name' => $this->media->alt_name,
                ];
            }),

            // Brand with logo
            'brand' => $this->whenLoaded('brand', function () {
                return [
                    'name' => $this->brand->name,
                    'media' => $this->brand->logo ? [
                        'media_url' => getAssetFileUrl("media", $this->brand->logo->file_name, disk: $this->brand->logo->disk),
                        'alt_name' => $this->brand->logo->alt_name,
                    ] : null,
                ];
            }),

            // Product Attributes with media
            'attributes' => $this->whenLoaded('attributes', function () {
                return $this->attributes->map(function ($attribute) {
                    return [
                        'key' => $attribute->attrs_key,
                        'value' => $attribute->attrs_value,
                    ];
                });
            }),

            'images' => $this->whenLoaded("images", function ($images) {
                return $images->map(function ($image) {
                    return [
                        'media_url' => getAssetFileUrl("media", $image->file_name, disk: $image->disk),
                        'alt_name' => $image->alt_name,
                    ];
                });
            }),
        ];
    }
}
