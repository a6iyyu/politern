<?php

namespace App\Providers;

use App\Http\Middleware\Admin;
use App\Http\Middleware\Mahasiswa;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Route::aliasMiddleware('admin', Admin::class);
        Route::aliasMiddleware('mahasiswa', Mahasiswa::class);
    }
}