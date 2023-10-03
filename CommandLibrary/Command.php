<?php

namespace App\CommandLibrary;

abstract class Command
{
    protected static $defaultName = null;

    protected static $defaultDescription = 'No description';

    abstract public function execute(Console $console, Parameters $arguments);


}