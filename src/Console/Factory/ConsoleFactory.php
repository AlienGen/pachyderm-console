<?php

namespace Pachyderm\Console\Factory;

use Pachyderm\Console\CommandInterface;
use Pachyderm\Console\CommandRegistry;

class ConsoleFactory
{
    public static function execute(?string $command, array $args, string $namespace = 'Src\Commands'): void {
        $registry = new CommandRegistry();

        self::discover($registry, $namespace);
        if(!$command) {
            echo "No command provided.\n\n";
            $registry->list();
            return;
        }

        $registry->run($command, $args);
    }

    private static function discover(CommandRegistry $registry, string $namespace): void
    {
        $commandDir = PACHYDERM_USER_PROJECT_ROOT. "src/Commands";
        foreach (glob($commandDir . '/*.php') as $file) {
            require_once $file;

            $className = pathinfo($file, PATHINFO_FILENAME);
            $fqcn = $namespace ? $namespace . "\\" . $className : $className;

            if (class_exists($fqcn)) {
                $instance = new $fqcn();
                if ($instance instanceof CommandInterface) {
                    $registry->register($instance);
                }
            }
        }
    }
}