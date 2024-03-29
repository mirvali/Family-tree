<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Wn\Generators\CommandsServiceProvider');
        }
        
        $this->app->bind('App\Repositories\Infrastructure\Contracts\RepositoryInterface');
        $this->app->bind('App\Repositories\Infrastructure\Contracts\AbstractRepository');
        $this->app->bind('App\Repositories\PersonRepository');
    }
}
