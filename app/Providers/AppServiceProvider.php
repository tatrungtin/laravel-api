<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env', 'local') == 'local') {
            Schema::defaultStringLength(191);
        }
        $this->checkRoles();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function checkRoles()
    {
        \Blade::if('hasPermission', function ($actionName = null) {
            $user = Auth::user();
            return $user->hasPermission($actionName);
        });

        \Blade::if('hasAtLeastOnePermission', function ($actionName = []) {
            $user = Auth::user();
            foreach ($actionName as $value) {
                if ($user->hasPermission($value))
                    return true;
            }
            return false;
        });
    }
}
