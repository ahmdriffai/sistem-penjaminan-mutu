<?php

namespace App\Providers;

use App\Services\Eloquent\PenjaminanMutuServiceImpl;
use App\Services\PenjaminanMutuService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PenjaminanMutuProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        PenjaminanMutuService::class => PenjaminanMutuServiceImpl::class,
    ];

    public function provides(): array
    {
        return [PenjaminanMutuService::class];
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
