<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

$config = require('web.php');
$config['controllerNamespace'] = 'app\commands';
$config['components']['urlManager']['scriptUrl'] = '';
// One of those aliases is not standard.
$config['aliases']['@web'] = dirname(__DIR__).'/web';
$config['aliases']['@webroot'] = dirname(__DIR__).'/web';
unset($config['components']['request']);
unset($config['components']['user']);
unset($config['controllerMap']);
unset($config['layout']);
unset($config['modules']['users']['controllerMap']);
unset($config['components']['view']);

return $config;
