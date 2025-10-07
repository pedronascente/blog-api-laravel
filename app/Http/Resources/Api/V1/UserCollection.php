<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => UserResource::collection($this->collection),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
    }
}
