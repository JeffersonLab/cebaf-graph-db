<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class DataSetResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        $resourceData = parent::toArray($request);
        $resourceData['data'] = DataResource::collection($this->resource->data)->toArray($request);
        $resourceData['config'] = $this->resource->config->yaml;

        return $resourceData;
    }
}
