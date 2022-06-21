<?php

namespace App\Providers;

use App\Services\Eloquent\FileDokumenServiceImpl;
use App\Services\FileDokumenService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FileDokumenServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        FileDokumenService::class => FileDokumenServiceImpl::class
    ];

    public function provides(): array
    {
        return [FileDokumenService::class];
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
