<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

define('CONSOLE', true); // CONSOLE must be true when this script is used.

// fcgi doesn't have STDIN and STDOUT defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));

// Check script arguments for specific parameters.
foreach($argv as $i => $arg)
{
    // If a specific environment is being forced.
    if(strpos($arg, '--env=') === 0)
    {
        define('YII_ENV', substr($arg, 6));
    }
    // If a specific database is being forced.
    else if(strpos($arg, '--db=') === 0)
    {
        define('DB_LOCATION', substr($arg, 5));
    }
    else
    {
        continue; // Skip argument.
    }
    
    // This argument should not be processed by Yii.
    unset($argv[$i]); 
    $_SERVER['argv'] = $argv;
    $_SERVER['argc'] = count($argv);
}

$applicationDirectory = __DIR__;

$config = require(__DIR__ . '/config/console.php');

exit(require(__DIR__.'/vendor/arza-studio/yiingine/yiingine.php'));