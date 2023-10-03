<?php

namespace App\CommandLibrary;

class Parameters
{
    private array $options = [];
    private array $arguments = [];

    public function __construct(array $params = [])
    {
        global $argv;

        if (count($argv) > 2) {
            $params = array_slice($argv, 2);
            $this->pars($params);
        }
    }

    private function pars(array $params): void
    {
        foreach ($params as $param) {

            $param = str_replace(['[', ']', '{', '}'], '', $param);

            if (strstr($param, '=') !== false) {
                list($key, $values) = explode('=', $param);
                $this->options[$key][] = $values;
            } else {
                $this->arguments[] = $param;
            }
        }
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function argumentExist(string $argument): bool
    {
        return in_array($argument, $this->arguments);
    }

}