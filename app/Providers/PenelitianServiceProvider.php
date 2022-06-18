<?php

namespace App\Providers;

use App\Services\Eloquent\PenelitianServiceImpl;
use App\Services\PenelitianService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PenelitianServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
      PenelitianService::class => PenelitianServiceImpl::class,
    ];

    public function provides(): array
    {
        return [PenelitianService::class];
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
