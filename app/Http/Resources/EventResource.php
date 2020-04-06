<?php

namespace App\Http\Resources;

use App\Http\Resources\EventDateResource;
use App\Http\Resources\EventTimeResource;
use App\Http\Resources\EventTimesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'user_id' => $this->id,
            'event_date' => EventDateResource::collection($this->eventDates)->first()->event_date,
            'slots' => new EventTimesResource($this->eventTimes)
        ];
    }
}
