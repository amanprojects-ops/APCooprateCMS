<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Share $settings from DB to all frontend sub-pages (about, services, contact).
        // The homepage (welcome) gets $settings directly from WelcomeController.
        View::composer('frontend.*', function ($view) {
            $data = $view->getData();
            if (! isset($data['settings'])) {
                $view->with('settings', \App\Models\Setting::allKeyed());
            }
        });
    }
}
