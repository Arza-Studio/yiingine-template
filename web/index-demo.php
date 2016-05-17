<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

// Make sure this file is only being used by the command line web server.
if(php_sapi_name() != 'cli-server')
{
    throw new Exception("This file can only be accessed using the command line server.");
}

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|woff|woff2})$/', $_SERVER["REQUEST_URI"])) 
{
    return false;    // serve the requested resource as-is.
}

if(strpos($_SERVER["REQUEST_URI"], 'fontawesome-webfont'))
{
    return false;
}

$applicationDirectory = dirname(__DIR__);

require(__DIR__.'/../vendor/arza-studio/yiingine/yiingine.php');

return;
