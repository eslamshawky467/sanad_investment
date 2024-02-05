<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class AllProperitiesResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'status' => true,
            'errNum' => "S000",
            'message'=>'Success'
        ];
    }
}
