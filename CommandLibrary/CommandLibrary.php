<?php

namespace App\CommandLibrary;

class CommandLibrary
{
    private Console $console;
    private Parameters $parameters;
    private array $commands = [];

    public function __construct(string $commandsDirectory)
    {
        $this->console = new Console();
        $this->parameters = new Parameters();

        if (!is_dir($commandsDirectory)) {
            $this->console->error('Directory not defined', true);
        }

        $this->initCommands($commandsDirectory);
    }

    private function initCommands(string $commandsDirectory)
    {
        $allFiles = new \RecursiveDirectoryIterator($commandsDirectory);
        $phpFiles = new \RegexIterator($allFiles, '/^.+\.php$/i');

        foreach ($phpFiles as $file) {
            require_once($file->getPathname());
            $className = str_replace('.php', '', $file->getFilename());

            $ref = new \ReflectionClass($className);
            $parent = $ref->getParentClass();

            if ($parent === false or $parent->name !== Command::class) {
                continue;
            }

            $commandName = $ref->getStaticPropertyValue('defaultName');

            if (!$commandName) {
                $this->console->error('Command name is not defined', true);
            }

            $commandDescription = $ref->getStaticPropertyValue('defaultDescription');

            $this->commands[$commandName] = [
                'class' => $className,
                'description' => $commandDescription
            ];
        }
    }

    public function startCommand(string $commandName): void
    {
        $command = $this->getCommand($commandName);
        $instance = new $command['class']();

        if ($this->parameters->argumentExist('help')) {
            $this->console->info($command['description']);
        } else {
            $instance->execute($this->console, $this->parameters);
        }
    }

    public function printAllCommands(): void
    {
        $this->console->info("Available commands: ");
        foreach ($this->commands as $name => $command) {
            $this->console->info($name . ' - ' . $command['description']);
        }
    }

    private function getCommand(string $commandName): array
    {
        if (!$this->commandExists($commandName)) {
            $this->console->error('Command not found', true);
        }

        return $this->commands[$commandName];
    }

    private function commandExists(string $commandName): bool
    {
        return array_key_exists($commandName, $this->commands);
    }
}