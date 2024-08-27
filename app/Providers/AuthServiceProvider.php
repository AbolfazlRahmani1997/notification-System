<?php

namespace App\Providers;

use App\Services\Interfaces\JwtServiceInterface;
use App\Services\JwtService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function register()
    {
        App::bind(JwtServiceInterface::class,JwtService::class);
    }
}
