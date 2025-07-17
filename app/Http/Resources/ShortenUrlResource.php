<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortenUrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'short_url' => route('url.redirect', [
                'short_code' => $this->resource->short_code
            ]),

            'original_url' => $this->resource->original_url,
            'short_code' => $this->resource->short_code
        ];
    }
}
