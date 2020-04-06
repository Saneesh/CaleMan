<?php

namespace App\Models\Repositories\EventDate;

use App\Models\Entities\EventDate;

class EventDateRepository implements EventDateRepositoryInterface
{
    // Eloquent model
    protected $eventDate;

    /**
     * Setting our class to the injected model.
     *
     * @param EventDate $eventDate
     *
     * @return EventRepository
     */
    public function __construct(EventDate $eventDate)
    {
        $this->eventDate = $eventDate;
    }

    /**
     * Returns the event object associated with the passed id.
     *
     * @param mixed $eventId
     *
     * @return Model
     */
    public function getEventDateById($eventDateId)
    {
        return $this->eventDate::findOrFail($eventDateId);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes) {
        return $this->eventDate::create($attributes);
    }

    
}
