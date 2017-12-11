<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Console\Command;

class GenerateSmartEntityPattern extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smart {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Smart Entity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->makeEntity($name);
    }

    public function makeEntity($name)
    {
        $this->call('make:smartentity', [
            'name' => "App\\Entities\\{$name}"
        ]);

        $this->call('make:smartrepocontract', [
            'name' => "App\\Contracts\\{$name}"
        ]);

        $this->call('make:smartrepo', [
            'name' => "App\\Repositories\\{$name}"
        ]);

        $this->call('make:smartprovider', [
           'name' => "App\\Providers\\{$name}"
        ]);

        $this->call('make:smartmodel', [
            'name' => "App\\Models\\{$name}\\MySQL\\{$name}"
        ]);
    }
}
