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

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'ServiceProvider.php';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/provider.stub';
    }
}
