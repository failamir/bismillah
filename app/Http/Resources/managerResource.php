<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class managerResource extends JsonResource
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
            'qwerty' => $this->qwerty,
            'asdf' => $this->asdf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'laila_id' => $this->laila_id
        ];
    }
}
