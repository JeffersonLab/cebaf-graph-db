<?php

namespace App\Http\Resources;

class DataResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $resourceData = parent::toArray($request);
        $resourceData['graph'] = '#';

        return $resourceData;
    }
}
