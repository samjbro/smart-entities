<?php

namespace SamJBro\SmartEntities\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class GenerateSmartEntityPattern extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smart {name} {--m|migration= : Make a migration for the model}';

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
        $this->info("Don't forget to add your new service provider to the config/app.php 'providers' array!");

        if ($this->option('migration')) {
            $this->createMigration();
        }
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
            'name' => "App\\Repositories\\{$name}\\MySQL\\{$name}"
        ]);

        $this->call('make:smartprovider', [
            'name' => "App\\Providers\\{$name}"
        ]);

        $this->call('make:smartmodel', [
            'name' => "App\\Models\\{$name}\\MySQL\\{$name}"
        ]);
    }

    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    protected function getOptions()
    {
        return [
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],
        ];
    }
}
