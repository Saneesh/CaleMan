<?php

namespace App\Models\Repositories\User;

use App\Models\Entities\User;
use App\Models\Repositories\User\UserInterface;
use App\Models\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registers the UserInterface with Laravels IoC Container.
     */
    public function register()
    {
        // Bind the returned class to the namespace 'App\Models\Repositories\User\UserInterface
        // $this->app->bind('App\Models\Repositories\User\UserInterface', function ($app) {
        //     return new UserRepository(new User());
        // });

        $this->app->bind(UserInterface::class, UserRepository::class);
    }
}
