<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => $this->items(),
            'total' => $this->total()
        ];
    }
}