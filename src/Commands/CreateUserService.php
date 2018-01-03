<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateUserService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartuserservice {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a User Service for the Smart Entity Pattern';

    public function handle()
    {
        $this->type = 'User';

        parent::handle( );
    }

    protected function getPath($name = 'User')
    {
        return $this->laravel['path'].'/Services/UserService.php';
    }


    protected function getStub()
    {
        return __DIR__.'/stubs/userservice.stub';
    }
}
