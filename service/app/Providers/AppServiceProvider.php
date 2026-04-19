<?php

namespace App\Providers;

use App\Repositories\EloquentPasswordRepository;
use App\Repositories\PasswordRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PasswordRepositoryInterface::class, EloquentPasswordRepository::class);
    }

    public function boot(): void {}
}
