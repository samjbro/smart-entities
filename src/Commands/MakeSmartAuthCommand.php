<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\Command;

class MakeSmartAuthCommand extends Command
{
    protected $signature = 'make:smartauth';

    public function handle()
    {

        $this->makeModel();
        $this->makeEntity();
        $this->makeRepository();
        $this->makeServiceProvider();
        $this->makeContract();
        $this->makeService();
        $this->addRoutes();
        $this->replaceRegisterController();
        $this->makeProvider();
        $this->info("Make sure to complete the following:");
        $this->info("1) Add your new service provider to the config/app.php 'providers' array.");
        $this->info("2) Register the SmartUserProvider in the AuthServiceProvider (see Readme).");
        $this->info("3) Update config/auth.php with the new provider details (see Readme).");

            // Delete or change references to Eloquent User Model?
            // Create User model from usermodel.stub
            // Create Base model if necessary
            // Create User entity from userentity.stub
            // Create Base entity if necessary
            // Create UserRepositoryContract
            // Create BaseRepositoryContract if necessary
            // Create UserServiceProvider
            // Create BaseServiceProvider if necessary
            // Create UserRepository
            // Create BaseRepository if necessary
            // Prompt the user to add service providers to config/app
            // Add UserService from userservice.stub
            // Add routes (same as make:auth)
            // Create/Modify RegisterController from registercontroller.stub
            // Create SmartUserProvider from userprovider.stub
            // Prompt the user (?) to modify config/auth
            // Modify AuthServiceProvider
    }

    public function makeModel()
    {
        $stub = __DIR__.'/stubs/usermodel.stub';
        $path = $this->laravel['path'] . '/Models/User/MySQL/User.php';
        copy($stub, $path);
    }

    public function makeEntity()
    {
        $stub = __DIR__.'/stubs/userentity.stub';
        $path = $this->laravel['path'] . '/Entities/User.php';
        copy($stub, $path);
    }

    public function makeProvider()
    {
        $stub = __DIR__.'/stubs/userprovider.stub';
        $path = $this->laravel['path'] . '/Extensions/SmartUserProvider.php';
        copy($stub, $path);
    }

    public function makeRepository()
    {
        $this->call('make:smartrepo', [
            'name' => "App\\Repositories\\User\\MySQL\\User"
        ]);

    }

    public function makeServiceProvider()
    {
        $this->call('make:smartprovider', [
            'name' => "App\\Providers\\User"
        ]);
    }

    public function makeContract()
    {
        $this->call('make:smartrepocontract', [
            'name' => "App\\Contracts\\User"
        ]);
    }

    public function makeService()
    {
        if ($this->alreadyExists('App\Services\UserService')) return false;

        $path = $this->laravel['path'] . "/Services/UserService.php";
        $this->makeDirectory($path);
        $stub = $this->files->get(__DIR__.'/stubs/userservice.stub');
        $this->files->put($path, $stub);
    }

    public function addRoutes(): void
    {
        file_put_contents(base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/stubs/make/routes.stub'),
            FILE_APPEND);
    }

    public function replaceRegisterController(): void
    {
        file_put_contents($this->laravel['path'] . "/Http/Controllers/Auth/RegisterController.php", __DIR__ . '/stubs/registercontroller.stub');
    }
}