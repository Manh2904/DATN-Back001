<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class PostApi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'k_name' => $this->k_name,
            'k_description' => $this->k_description,
            'k_hot' => $this->k_hot,
            'k_active' => $this->k_active,
        ];
    }
}
