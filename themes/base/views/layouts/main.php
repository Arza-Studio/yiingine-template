<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

use \yii\helpers\Url;
use \yiingine\widgets\Background;

$this->beginContent('@app/views/layouts/main.php');

# Background (begin)
// If a background image is set in a child view.
if(Yii::$app->getParameter('background'))
{
    $background = Url::to(Yii::$app->getParameter('background'));
}
// Or if a default background is set.
elseif(Yii::$app->getParameter('app.default_background'))
{
    $background = Yii::$app->request->baseUrl.'/user/assets/'.Yii::$app->getParameter('app.default_background');
}
if(isset($background))
{
    Background::begin([
        'layers' => [
            [
                'type' => Background::TYPE_COLOR, // Remplace body background to add more flexibility
                'color' => Yii::$app->palette->get('Gray', 90)
            ],
            [
                'type' => Background::TYPE_IMAGE,
                'url' => $background,
                'opacity' => '0.15',
                'css' => 'background-position: bottom; min-height: 800px;'
            ],
            [
                'type' => Background::TYPE_GRADIENT,
                'range' => [
                    '{imageTop}' => Yii::$app->palette->rgba('Gray', 90, 1),
                    '100%' => Yii::$app->palette->rgba('Gray', 90, 0)
                ],
                'css' => 'padding-bottom: 30px; min-height: 800px;',
            ],
        ]
    ]);
}

echo $content;
    
# Background (end)
if(isset($background))
{
    Background::end();
}

$theme = $this->theme;
$this->theme = null; // Momentarily deavtivate theming to prevent recursive rendering of this file. 
$this->endContent();
$this->theme = $theme;
