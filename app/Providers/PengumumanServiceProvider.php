<?php

namespace App\Providers;

use App\Services\Eloquent\PengumumanServiceImpl;
use App\Services\PengumumanService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PengumumanServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
      PengumumanService::class => PengumumanServiceImpl::class
    ];

    public function provides(): array
    {
        return [PengumumanService::class];
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
