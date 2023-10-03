<?php

namespace App\CommandLibrary;

class Console
{
    public function info(string $message)
    {
        $this->output($message);
    }

    public function error(string $message, bool $stop = false)
    {
        $this->output('Error: ' . $message, 31);

        if ($stop) {
            die;
        }
    }

    private function output(string $message, int $color = 0): void
    {
        $message = "\033[" . $color . "m" . $message . "\033[0m";

        echo $message . PHP_EOL;
    }
}