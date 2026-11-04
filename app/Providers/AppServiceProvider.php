<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Nama bulan dan hari berbahasa Indonesia (mengikuti APP_LOCALE)
        Carbon::setLocale(config('app.locale'));

        // Pagination memakai tampilan sendiri yang senada dengan tema
        Paginator::defaultView('vendor.pagination.custom');
        Paginator::defaultSimpleView('vendor.pagination.custom');
    }
}
