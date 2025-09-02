<?php
namespace Pachyderm\Console;


use Pachyderm\Console\Factory\ConsoleFactory;

// Get the package directory
define('PACHYDERM_MIGRATION_ROOT', __DIR__);

// Get the user project root from the package directory
define('PACHYDERM_USER_PROJECT_ROOT', __DIR__ . '/../../../');

// Check if the project is installed with Composer
if (!file_exists(PACHYDERM_USER_PROJECT_ROOT . '/vendor/autoload.php')) {
    echo "Please run `composer install` to install the dependencies.\n";
    exit(1);
}

// Require the autoload.php file
require_once PACHYDERM_USER_PROJECT_ROOT . '/vendor/autoload.php';

$argv = $_SERVER['argv'];
array_shift($argv); // remove script name
$command = $argv[0] ?? null;
$args = array_slice($argv, 1);

ConsoleFactory::execute($command, $args);