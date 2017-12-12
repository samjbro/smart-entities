<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateProvider extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartprovider {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Service Provider for the Smart Entity Pattern';

    public function handle()
    {
        $this->createBaseProvider();

        parent::handle( );
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'ServiceProvider.php';
    }

    protected function createBaseProvider()
    {
        if ($this->alreadyExists('App\Providers\Base')) return false;

        $path = $this->laravel['path'] . "/Providers/BaseServiceProvider.php";
        $this->makeDirectory($path);
        $stub = $this->files->get(__DIR__.'/stubs/baseprovider.stub');
        $this->files->put($path, $stub);
        $this->info("Make sure to add the BaseServiceProvider to the config/app.php 'providers' array!");
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/provider.stub';
    }
}
