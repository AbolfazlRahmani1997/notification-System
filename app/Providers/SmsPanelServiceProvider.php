<?php

namespace App\Providers;

use App\Repositories\Interfaces\SmsPanelRepositoryInterface;
use App\Repositories\Interfaces\TemplateRepositoryInterface;
use App\Repositories\SmsPanelRepository;
use App\Repositories\TemplateRepository;
use App\Services\Interfaces\SmsPanelServiceInterface;
use App\Services\Interfaces\TemplateServiceInterface;
use App\Services\SmsPanelService;
use App\Services\TemplateService;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\App;

class SmsPanelServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::bind(SmsPanelServiceInterface::class, SmsPanelService::class);
        App::bind(SmsPanelRepositoryInterface::class, SmsPanelRepository::class);
        App::bind(TemplateServiceInterface::class, TemplateService::class);
        App::bind(TemplateRepositoryInterface::class, TemplateRepository::class);
    }
}
