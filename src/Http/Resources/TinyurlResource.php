<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TinyurlResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'url'        => $this->url,
            'slug'       => $this->slug,
            'redirect'   => $this->redirect,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
