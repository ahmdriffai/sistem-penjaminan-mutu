<?php

namespace App\Providers;

use App\Services\DokumenMutuService;
use App\Services\Eloquent\DokumenMutuServiceImpl;
use App\Services\PenjaminanMutuService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DokumenMutuServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        DokumenMutuService::class => DokumenMutuServiceImpl::class
    ];

    public function provides(): array
    {
        return [DokumenMutuService::class];
    }

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
