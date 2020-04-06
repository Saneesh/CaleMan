<?php

namespace App\Models\Repositories\EventTime;

use App\Models\Entities\Event;
use App\Models\Repositories\EventTime\EventTimeRepository;
use App\Models\Repositories\EventTime\EventTimeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class EventTimeRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registers the EventInterface with Laravels IoC Container.
     */
    public function register()
    {
        $this->app->bind(EventTimeRepositoryInterface::class, EventTimeRepository::class);
    }
}
