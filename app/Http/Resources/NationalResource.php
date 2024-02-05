<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NationalResource extends JsonResource
{

    public function toArray($request)
    {
        if (isset($request->lang) && $request->lang == 'en') {
            return [
                'id' => $this->id,
                'name' => $this->name_en,
            ];
        } else {
            return [
                'id' => $this->id,
                'name' => $this->name_ar,
            ];
        }
    }
}
