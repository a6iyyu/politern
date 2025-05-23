<?php

namespace App\Providers;

use App\Http\Middleware\RemovePageOne;
use Carbon\Carbon;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(Kernel $kernel): void
    {
        $kernel->pushMiddleware(RemovePageOne::class);
        Paginator::defaultView('shared.navigation.pagination');
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'id');
    }
}