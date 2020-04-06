<?php

namespace App\Models\Repositories\EventDate;

use App\Models\Entities\EventDate;
use App\Models\Entities\User;

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
    public function __construct(EventDate $eventDate, User $user)
    {
        $this->eventDate = $eventDate;
        $this->user = $user;
    }

    /**
     * Returns the event object associated with the passed id.
     *
     * @param mixed $eventDateId
     *
     * @return Model
     */
    public function getEventDateById($eventDateId)
    {
        return $this->eventDate::findOrFail($eventDateId);
    }

    /**
     * Get events of a user by date.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function getEventsByDate(array $attributes) {
        return auth()->user()::with([
            'eventDates' => function ($query) use ($attributes) {
                $query->whereDate('event_date', $attributes['event_date']);
            }, 'eventTimes'])
        ->where('id', $attributes['user_id'])
        ->get()
        ->first();
    }

    /**
     * Book an event.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function bookEvent(array $attributes)
    {
        $inviter = $this->user::where(['id' => $attributes['inviter_id']])->first();

        return $inviter->eventDates([
            'event_date' => $attributes['event_date']
        ])
        ->first()
        ->eventTimes([
            'slot_start' => $attributes['slot_start'],
            'slot_end' => $attributes['slot_end']
        ])->update(['event_times.is_booked' => true]);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->eventDate::create($attributes);
    }
}
