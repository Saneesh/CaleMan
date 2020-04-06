<?php

namespace App\Models\Repositories\EventTime;

use App\Models\Entities\EventTime;

class EventTimeRepository implements EventTimeRepositoryInterface
{
    // Eloquent model
    protected $eventTime;

    /**
     * Setting our class to the injected model.
     *
     * @param EventTime $eventTime
     *
     * @return EventRepository
     */
    public function __construct(EventTime $eventTime)
    {
        $this->eventTime = $eventTime;
    }

    /**
     * Returns the event object associated with the passed id.
     *
     * @param mixed $eventTimeId
     *
     * @return Model
     */
    public function getEventTimeById($eventTimeId)
    {
        return $this->eventTime::findOrFail($eventTimeId);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes) {
        return $this->eventTime::create($attributes);
    }
}
