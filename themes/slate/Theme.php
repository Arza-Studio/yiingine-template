<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

namespace app\themes\slate;

use \Yii;

/**
 * Theme class for the modern business bootstrap theme.
 * @author Antoine Mercier-Linteau <antoine.mercier-linteau@arza-studio.com>
 * */
class Theme extends \yiingine\base\Theme
{
    /**
     * @inheritdoc
     * */
    public $assetBundle = '\app\themes\slate\Asset';
}

/**
 * AssetBundle for the theme.
 */
class Asset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/themes/slate/web';
    
    public $css = [
        'bootstrap.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
