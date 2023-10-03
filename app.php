<?php

require_once('vendor/autoload.php');

use App\CommandLibrary\CommandLibrary;

$commandName = $argv[1] ?? null;
$commandsDir = __DIR__ . '/Commands';

$lib = new CommandLibrary($commandsDir);

if ($commandName) {
    $lib->startCommand($commandName);
} else {
    $lib->printAllCommands();
}