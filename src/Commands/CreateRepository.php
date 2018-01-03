<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartrepo {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an Eloquent Repository for the Smart Entity Pattern';

    public function handle()
    {
        $this->type = $this->qualifyClass($this->getNameInput());
        $this->createBaseRepository();

        parent::handle( );
    }

    protected function createBaseRepository()
    {
        if ($this->alreadyExists('App\Entities\Base')) return false;

        $path = $this->laravel['path'] . "/Repositories/Base/MySQL/BaseRepository.php";
        $this->makeDirectory($path);
        $stub = $this->files->get(__DIR__.'/stubs/baserepo.stub');
        $this->files->put($path, $stub);
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Repository.php';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/repo.stub';
    }

}
