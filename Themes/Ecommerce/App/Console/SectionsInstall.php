<?php

namespace Themes\Ecommerce\App\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

use Themes\Ecommerce\App\Services\TomatoEcommerceSectionsBuilder;

class SectionsInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'themes:ecommerce-sections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'use to generate sections for ecommerce theme';

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
        TomatoEcommerceSectionsBuilder::build();
    }
}
