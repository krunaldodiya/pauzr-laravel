<?php

namespace App\Providers;

use App\Repositories\OtpRepository;
use App\Repositories\OtpRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
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
        app()->bind(OtpRepositoryInterface::class, OtpRepository::class);
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
