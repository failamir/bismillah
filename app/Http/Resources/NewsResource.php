<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'tittle' => $this->tittle,
            'content' => $this->content,
            'writer' => $this->writer,
            'published' => $this->published,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
