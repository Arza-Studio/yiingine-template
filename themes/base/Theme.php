<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

namespace app\themes\base;

/**
 * Base theme for the yiingine.
 * @author Antoine Mercier-Linteau <antoine.mercier-linteau@arza-studio.com>
 * */
class Theme extends \yiingine\base\Theme
{
    /**
     * @inheritdoc
     * */
    public $assetBundle = '\app\themes\base\Asset';
    
    /**
     * @inheritdoc
     * */
    /*public function init()
    {
        $this->setBasePath('@app');
        $this->setBaseUrl('@web');
        
        \yii\base\Theme::init();    
    }*/
}

/**
 * AssetBundle for the Base theme.
 */
class Asset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/themes/base/web';
    
    public $css = [
        'css/views/layouts/main.css',
        //'css/views/layouts/form.css',
        'css/views/layouts/font-face.css',
        'css/menus/mainMenu.css',
        'css/menus/footerMenu.css'
    ];
    public $depends = [
        'app\assets\AppAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapThemeAsset'
    ];
    
    /**
     * @inheritdoc
     * */
    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);
        
        $view->requireFile('//layouts/assets');
    }
}
