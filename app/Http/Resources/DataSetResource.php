<?php

namespace App\Http\Resources;

class DataSetResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $resourceData = parent::toArray($request);
        $resourceData['data'] = DataResource::collection($this->resource->data)->toArray($request);
        $resourceData['config'] = $this->resource->config->yaml;

        return $resourceData;
    }
}
