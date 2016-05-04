<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

namespace app\controllers;

/**
* The main controller for the front-end.
* @author Antoine Mercier-Linteau <antoine.mercier-linteau@arza-studio.com>
*/
class SiteController extends \yiingine\controllers\SiteController
{    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return array_merge(
            parent::actions(), 
            // Add the actions required by the Address widget.
            \yiingine\widgets\Microformats::actions()
        );
    }
}
