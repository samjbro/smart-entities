<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateSmartEntity extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartentity {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an Entity for the Smart Entity Pattern';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }


    public function handle()
    {
        $this->type = $this->qualifyClass($this->getNameInput());
        $this->createBaseEntity();
        $this->addEntityException();
        parent::handle( );
    }
    protected function createBaseEntity()
    {
        if ($this->alreadyExists('App\Entities\Base')) return false;

        $path = $this->laravel['path'] . "/Entities/BaseEntity.php";
        $this->makeDirectory($path);
        $stub = $this->files->get(__DIR__.'/stubs/baseentity.stub');
        $this->files->put($path, $stub);
    }

    protected function addEntityException()
    {
        $exceptionName = 'App\Exceptions\RestrictedEntityException';
        if ($this->files->exists($this->getUnalteredPath($this->qualifyClass($exceptionName)))) {
            return false;
        }

        if ($this->alreadyExists('App\Exceptions\RestrictedEntityException')) return false;

        $path = $this->laravel['path'] . "/Exceptions/RestrictedEntityException.php";
        $this->makeDirectory($path);
        $stub = $this->files->get(__DIR__.'/stubs/restrictedentity.stub');
        $this->files->put($path, $stub);
    }

    protected function getPath($name)
    {
        return $this->laravel['path'].'/Entities/UserEntity.php';
    }

    protected function getUnalteredPath($name)
    {
        return parent::getPath($name);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/userentity.stub';
    }

//    protected function buildClass($name)
//    {
//        $stub = parent::buildClass($name);
//
//        return $this->replaceContract($stub, $name);
//
//    }
//
//    protected function replaceContract(&$stub, $name)
//    {
//        $class = str_replace($this->getNamespace($name).'\\', '', $name);
//
//        $stub = str_replace(
//            ['DummyRepositoryContract'],
//            [$class . 'RepositoryContract'],
//            $stub
//        );
//
//        return $stub;
//    }
}
