<?php

use App\CommandLibrary\Command;
use App\CommandLibrary\Console;
use App\CommandLibrary\Parameters;

class TestCommand extends Command
{
    protected static $defaultName = 'test';
    protected static $defaultDescription = 'Test description';

    public function execute(Console $console, Parameters $arguments)
    {
        $console->info('Called command: ' . self::$defaultName);
    }

}