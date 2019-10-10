<?php

namespace App\Providers;

use App\Http\Responses\APIResponse;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Event for JWT error
        Event::listen('tymon.jwt.absent', function () {
            return APIResponse::error400('A token is required');
        });
        Event::listen('tymon.jwt.user_not_found', function () {
            return APIResponse::error404('User not found');
        });
        Event::listen('tymon.jwt.invalid', function () {
            return APIResponse::error400('Token is invalid');
        });
        Event::listen('tymon.jwt.expired', function () {
            return APIResponse::error401('Your session is expired. Please login again');
        });
    }
}
