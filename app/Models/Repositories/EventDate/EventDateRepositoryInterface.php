<?php

namespace App\Models\Repositories\EventDate;

interface EventDateRepositoryInterface
{
    /**
     * Get eventDate by id.
     */
    public function getEventDateById($eventDateId);
    public function getEventsByDate(array $attributes);

    public function create(array $attributes);
}
