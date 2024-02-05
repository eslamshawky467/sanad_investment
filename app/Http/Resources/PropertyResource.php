<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'description' => $this->description,
            'total_price'=> $this->total_price,
            'unit_price'=> $this->unit_price,
              'total_units'=>$this->total_units,
               'remain_units'=>$this->remain_units,
            'min_investement'=> $this->min_investement,
            'last_investement_date'=> $this->last_investement_date,
            'investement_percentage'=> $this->investement_percentage,
            'penefits_from_investement'=> $this->penefits_from_investement,
            'location'=> $this->location,
            'Name_of_own_box'=> $this->Name_of_own_box,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'category_1'=>$this->category_1,
            'category_2'=>$this->category_2,
            'category_3'=>$this->category_3,
            'file'=>ImageResource::collection($this->file),
        ];
    }
}
