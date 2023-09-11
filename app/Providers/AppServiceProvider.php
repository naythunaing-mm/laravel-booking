<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Bed\BedRepositoryInterface;
use App\Repository\Bed\BedRepository;
use App\Repository\View\ViewRepositoryInterface;
use App\Repository\View\ViewRepository;
use App\Repository\Amenity\AmenityRepositoryInterface;
use App\Repository\Amenity\AmenityRepository;
use App\Repository\Room\RoomRepository;
use App\Repository\Room\RoomRepositoryInterface;
use App\Repository\Feature\FeatureRepository;
use App\Repository\Feature\FeatureRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->bind(ViewRepositoryInterface::class, ViewRepository::class);
        $this->app->bind(BedRepositoryInterface::class, BedRepository::class);
        $this->app->bind(AmenityRepositoryInterface::class, AmenityRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
