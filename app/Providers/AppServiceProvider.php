<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mappingRepositoryInjections();

        // Ignore Sanctum's default migrations
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register repositories to controller injection interfaces.
     *
     * @return void
     */
    protected function mappingRepositoryInjections()
    {
        foreach (config('minmax.repository_injections', []) as $injection) {
            $this->app->when($injection[0])
                ->needs('Minmax\Foundation\Contracts\AdminRepositoryInterface')
                ->give($injection[1]);
        }
    }
}
