<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SertifikatPelatihanWebinar;
use App\Models\SertifikatPelatihanKlasikal;
use App\Models\SertifikatPelatihanJarakJauh;
use App\Observers\SertifikatPelatihanWebinarObserver;
use App\Observers\SertifikatPelatihanKlasikalObserver;
use App\Observers\SertifikatPelatihanJarakJauhObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers for certificate models
        SertifikatPelatihanWebinar::observe(SertifikatPelatihanWebinarObserver::class);
        SertifikatPelatihanKlasikal::observe(SertifikatPelatihanKlasikalObserver::class);
        SertifikatPelatihanJarakJauh::observe(SertifikatPelatihanJarakJauhObserver::class);
    }
}
