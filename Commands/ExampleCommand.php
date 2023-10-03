<?php

use App\CommandLibrary\Command;
use App\CommandLibrary\Console;
use App\CommandLibrary\Parameters;

class ExampleCommand extends Command
{
    protected static $defaultName = 'example';
    protected static $defaultDescription = 'Example description';

    public function execute(Console $console, Parameters $arguments)
    {
        $console->info('Called command: ' . self::$defaultName);

        $console->info('');

        $console->info('Parameters: ');
        foreach ($arguments->getArguments() as $argument) {
            $console->info(' - ' . $argument);
        }

        $console->info('');

        $console->info('Options: ');
        foreach ($arguments->getOptions() as $key => $option) {
            $console->info(' - ' . $key);
            foreach ($option as $value) {
                $console->info('  - ' . $value);
            }

        }
    }
}