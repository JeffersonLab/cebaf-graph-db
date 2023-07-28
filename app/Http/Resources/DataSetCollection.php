<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DataSetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): Arrayable
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'comment' => $item->comment,
                'graphCount' => $item->data()->count(),
            ];
        });
    }
}
