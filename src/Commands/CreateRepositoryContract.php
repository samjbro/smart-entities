<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateRepositoryContract extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smartrepocontract {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Repository Contract for the Smart Entity Pattern';

    public function handle()
    {
        parent::handle( );
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'RepositoryContract.php';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/repocontract.stub';
    }

}
