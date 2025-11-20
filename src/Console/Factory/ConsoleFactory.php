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

    private static function discover(CommandRegistry $registry, string $baseNamespace): void
    {
        $commandDir = PACHYDERM_USER_PROJECT_ROOT . "src/Commands";

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($commandDir)
        );

        foreach ($iterator as $file) {
            if ($file->isDir()) {
                continue;
            }

            if ($file->getExtension() !== 'php') {
                continue;
            }

            require_once $file->getRealPath();

            $relativePath = str_replace($commandDir, '', $file->getPath());
            $relativePath = trim($relativePath, DIRECTORY_SEPARATOR);

            $subNamespace = $relativePath
                ? $baseNamespace . "\\" . str_replace('/', '\\', $relativePath)
                : $baseNamespace;

            $className = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            $fqcn = $subNamespace . "\\" . $className;

            if (class_exists($fqcn)) {
                if (is_subclass_of($fqcn, CommandInterface::class)) {
                    $instance = new $fqcn();
                    $registry->register($instance);
                }
            }
        }
    }
}
