<?php

namespace App\Models\Repositories\User;

use App\Models\Entities\User;

class UserRepository implements UserInterface
{
    // Our Eloquent models
    protected $user;

    /**
     * Setting our class to the injected model.
     *
     * @param User $user
     *
     * @return UserRepository
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Returns the user object associated with the passed id.
     *
     * @param mixed $userId
     *
     * @return Model
     */
    public function getUserById($userId)
    {
        return $this->user::findOrFail($userId);
    }

    public function getEventsByDate(array $attributes) {
        //return $this->user::with('EventDate', 'EventTime')->findOrFail($attributes);

        //$userId = Auth::id();

        // return $this->user::all();

        return $this->user::with([
            'eventDates' => function ($query) use ($attributes) {
                $query->whereDate('event_date', $attributes['event_date']);
            }, 'eventTimes'])
        ->where('id', $attributes['user_id'])
        ->get()
        ->first();
    }
}
