<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [

            'id'=> $this->id,
            'file_name'=> $this->file_name,
            'type'=>$this->type,
        ];
    }
}
