<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->category,
            'media_url' => $this->media_url,
            'meta_title' => $this->media_url,
            'meta_description' => $this->media_url,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
            "sub_cats" => QuotationResource::collection($this->subCats),

            // 'questions' => $this->whenLoaded('questions', function () {
            //     return $this->questions->map(function ($question) {

            //         return [

            //             'id' => $question->id,
            //             'question' => $question->question,
            //             'options' => $question->options->map(function ($option) {

            //                 return [

            //                     'id' => $option->id,
            //                     'option' => $option->option,
            //                     'type' => $option->type,

            //                 ];
            //             })
            //         ];
            //     });
            // }),
        ];
    }
}
