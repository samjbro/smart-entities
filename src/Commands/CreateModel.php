<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class CreateModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartmodel {name}';

    public function __construct(Filesystem $files)
    {
        $this->type = $this->qualifyClass($this->getNameInput());
        parent::__construct($files);

    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an Eloquent Model for the Smart Entity Pattern';



    public function handle()
    {
        $this->createBaseModel();

        parent::handle( );
    }

    protected function createBaseModel()
    {
        if ($this->alreadyExists('App\Models\Base\MySQL\Base')) return false;

        $path = $this->laravel['path'] . "/Models/Base/MySQL/BaseModel.php";
        $this->makeDirectory($path);
        $stub = $this->files->get(__DIR__.'/stubs/basemodel.stub');
        $this->files->put($path, $stub);
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Model.php';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        return $this->replaceTableName($stub, $name);

    }

    protected function replaceTableName(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $tableName = str_plural(snake_case($class));
        $stub = str_replace(
            ['dummytablename'],
            [$tableName],
            $stub
        );

        return $stub;
    }
}
