<?php

namespace Pachyderm\Console;

class CommandRegistry {

    private array $commands = [];

    public function register(CommandInterface $command): void {
        $this->commands[$command->getName()] = $command;
    }

    public function run(string $name, array $arguments = []): void {
        if (!isset($this->commands[$name])) {
            echo "Command '$name' not found.\n";
            $this->list();
            return;
        }
        $this->commands[$name]->run($arguments);
    }

    public function list(): void {
        echo "Available commands:\n";
        foreach ($this->commands as $command) {
            echo "  " . $command->getName() . " - " . $command->getDescription() . "\n";
        }
    }
}