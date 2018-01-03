<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateUserModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartusermodel {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a User Model for the Smart Entity Pattern';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    public function handle()
    {
        $this->type = 'User';
        $this->createBaseModel();
        parent::handle( );
    }

    protected function getPath($name)
    {
        return $this->laravel['path'].'/Models/User/MySQL/User.php';
    }


    protected function getStub()
    {
        return __DIR__.'/stubs/usermodel.stub';
    }

    protected function createBaseModel()
    {
//        if ($this->alreadyExists('App\Models\Base\MySQL\Base')) return false;

        $path = $this->laravel['path'] . "/Models/Base/MySQL/Base.php";
        $this->makeDirectory($path);
        $stub = $this->files->get(__DIR__.'/stubs/basemodel.stub');
        $this->files->put($path, $stub);
    }

}
