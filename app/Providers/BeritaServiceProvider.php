<?php

namespace App\Providers;

use App\Services\BeritaService;
use App\Services\Eloquent\BeritaServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BeritaServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        BeritaService::class => BeritaServiceImpl::class
    ];

    public function provides(): array
    {
        return [BeritaService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
