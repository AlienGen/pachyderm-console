<?php

namespace Pachyderm\Console\Service;

class SetupService {
    /**
     * Set up the commands structure in the given project root
     *
     * @param string $projectRoot
     * @param callable|null $outputCallback Optional callback for output messages
     */
    public static function setup(string $projectRoot, ?callable $outputCallback = null): void
    {
        $output = $outputCallback ?? function($message) {
            echo $message . "\n";
        };

        // Create commands directory
        $commandsDir = $projectRoot . '/src/Commands';
        if (!is_dir($commandsDir)) {
            mkdir($commandsDir, 0777, true);
            $output("Created src/Commands folder");
        } else {
            $output("src/Commands folder already exists");
        }

        // Create console.php file
        $consoleFile = $projectRoot . '/console.php';
        if (!file_exists($consoleFile)) {
            $consoleContent = "<?php\n\nrequire_once __DIR__ . '/vendor/aliengen/pachyderm-console/Console.php';\n";
            file_put_contents($consoleFile, $consoleContent);
            $output("Created console.php file");
        } else {
            $output("console.php file already exists");
        }

        $output("Setup complete! You can now run commands with: php console.php");
    }
}