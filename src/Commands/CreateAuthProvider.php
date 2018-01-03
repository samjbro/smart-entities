<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateAuthProvider extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartauthprovider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an Auth Provider for the Smart Entity Pattern';

    public function handle()
    {
        $this->type = $this->qualifyClass($this->getNameInput());

        parent::handle( );
    }

    protected function getPath($name = 'User')
    {
        return $this->laravel['path'].'/Extensions/SmartUserProvider.php';
    }


    protected function getStub()
    {
        return __DIR__.'/stubs/userprovider.stub';
    }
}
