<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateUserModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartusermodel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a User Model for the Smart Entity Pattern';

    public function handle()
    {
        $this->type = 'User';

        parent::handle( );
    }

    protected function getPath($name = 'User')
    {
        return $this->laravel['path'].'/Models/User/MySQL/User.php';
    }


    protected function getStub()
    {
        return __DIR__.'/stubs/usermodel.stub';
    }
}
