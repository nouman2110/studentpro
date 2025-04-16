<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as View;

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
       
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn (): View => view('filament.login_extra'),
        );

        FilamentView::registerRenderHook(
            'panels::body.start',

            fn (): View => view('custom-page'),
        );
    }
}
