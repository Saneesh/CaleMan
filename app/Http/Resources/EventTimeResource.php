<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventTimeResource extends JsonResource
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
            'slot_start' => $this->slot_start,
            'slot_end' => $this->slot_end,
            'is_booked' => $this->is_booked
        ];
    }
}
