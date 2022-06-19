<?php

namespace App\Providers;

use App\Services\Eloquent\PaperIlmiahServiceImpl;
use App\Services\PaperIlmiahService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PaperIlmiahServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        PaperIlmiahService::class => PaperIlmiahServiceImpl::class,
    ];

    public function provides(): array
    {
        return [PaperIlmiahService::class];
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
