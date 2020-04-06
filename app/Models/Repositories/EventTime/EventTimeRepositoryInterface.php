<?php

namespace App\Models\Repositories\EventTime;

interface EventTimeRepositoryInterface
{
    /**
     * Get eventTime by id.
     */
    public function getEventTimeById($eventTimeId);

    public function create(array $attributes);

    
}
