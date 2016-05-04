<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

# DATABASE LOCATION DEPENDENT CONFIGURATION
switch($dbLocation)
{
    case 'production':
        echo "Production database not set.\n"; die;
        break;
    case 'local':
        $config['components']['db']['dsn'] = 'mysql:host=127.0.0.1;port=3306;dbname=example';
        $config['components']['db']['username'] = 'example';
        $config['components']['db']['password'] = 'example';
        break;
    case 'development':
        // Use development database on webserver.
        $config['components']['db']['dsn'] = 'mysql:host=db.example.com;port=3306;dbname=example';
        $config['components']['db']['username'] = 'example';
        $config['components']['db']['password'] = 'example';
        break;
    default:
        echo "\"$dbLocation\" is not a valid database for this application.\n";
        die;
}
