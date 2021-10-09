<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SafitriResource extends JsonResource
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
            'image' => $this->image,
            'file' => $this->file,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}