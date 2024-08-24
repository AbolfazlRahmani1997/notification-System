<?php

namespace App\Providers;

use App\Repositories\Interfaces\SmsPanelRepositoryInterface;
use App\Repositories\SmsPanelRepository;
use App\Services\Interfaces\SmsPanelServiceInterface;
use App\Services\SmsService;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\App;

class SmsPanelServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::bind(SmsPanelServiceInterface::class, SmsService::class);
        App::bind(SmsPanelRepositoryInterface::class, SmsPanelRepository::class);
    }
}
