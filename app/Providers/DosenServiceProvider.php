<?php

namespace App\Providers;

use App\Services\DosenService;
use App\Services\Eloquent\DosenServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DosenServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        DosenService::class => DosenServiceImpl::class,
    ];

    public function provides(): array
    {
        return [DosenService::class];
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
