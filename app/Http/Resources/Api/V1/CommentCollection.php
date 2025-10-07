<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => CommentResource::collection($this->collection),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
    }
}
