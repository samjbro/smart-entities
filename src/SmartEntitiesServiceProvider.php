<?php

namespace SamJBro\SmartEntities;

use SamJBro\SmartEntities\Commands\CreateModel;
use SamJBro\SmartEntities\Commands\CreateProvider;
use SamJBro\SmartEntities\Commands\CreateRepository;
use SamJBro\SmartEntities\Commands\CreateRepositoryContract;
use SamJBro\SmartEntities\Commands\CreateSmartEntity;
use SamJBro\SmartEntities\Commands\GenerateSmartEntityPattern;
use Illuminate\Support\ServiceProvider;
use SamJBro\SmartEntities\Commands\MakeSmartAuthCommand;

class SmartEntitiesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateSmartEntityPattern::class,
                CreateSmartEntity::class,
                CreateRepositoryContract::class,
                CreateRepository::class,
                CreateProvider::class,
                CreateModel::class,
                MakeSmartAuthCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

}
