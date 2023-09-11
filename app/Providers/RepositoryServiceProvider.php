<?php

namespace App\Providers;

use App\Models\View;
use Illuminate\Support\ServiceProvider;
use App\Repository\View\ViewRepositoryInterface;
use App\Repository\View\ViewRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ViewRepositoryInterface::class,ViewRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
