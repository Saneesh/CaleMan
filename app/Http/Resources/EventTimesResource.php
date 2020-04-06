<?php

namespace App\Http\Resources;

use App\Http\Resources\EventTimeResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventTimesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
           return new EventTimeResource($item);
        });
    }
}
