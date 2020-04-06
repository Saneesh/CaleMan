<?php

namespace App\Models\Repositories\EventDate;

use App\Models\Entities\Event;
use App\Models\Repositories\EventDate\EventDateRepository;
use App\Models\Repositories\EventDate\EventDateRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class EventDateRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registers the EventInterface with Laravels IoC Container.
     */
    public function register()
    {
        // Bind the returned class to the namespace 'App\Models\Repositories\Event\EventInterface
        // $this->app->bind('App\Models\Repositories\Event\EventInterface', function ($app) {
        //     return new EventRepository(new Event());
        // });

        $this->app->bind(EventDateRepositoryInterface::class, EventDateRepository::class);
    }
}
