<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Generic AssetBundle for the application.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/bootstrap-hover-dropdown.min.js' 
    ];
    public $depends = [
    	'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    	'yii\bootstrap\BootstrapPluginAsset',
    ];
}

