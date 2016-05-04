<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

namespace app\themes\lumen;

use \Yii;

/**
 * Theme class for the lumen bootstrap theme.
 * @author Antoine Mercier-Linteau <antoine.mercier-linteau@arza-studio.com>
 * */
class Theme extends \yiingine\base\Theme
{
    /**
     * @inheritdoc
     * */
    public $assetBundle = '\app\themes\lumen\Asset';
}

/**
 * AssetBundle for the theme.
 */
class Asset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/themes/lumen/web';
    
    public $css = [
        'bootstrap.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
