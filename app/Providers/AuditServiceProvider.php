<?php

namespace App\Providers;

use App\Services\AuditService;
use App\Services\Eloquent\AuditServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AuditServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        AuditService::class => AuditServiceImpl::class,
    ];

    public function provides(): array
    {
        return [AuditService::class];
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
