<?php

namespace App\Providers;

use App\Services\Eloquent\PengabdianServiceImpl;
use App\Services\PengabdianService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PengabdianServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        PengabdianService::class => PengabdianServiceImpl::class,
    ];

    public function provides(): array
    {
        return [PengabdianService::class];
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
