<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

use \yii\web\View;

# Application assets
$this->registerAssetBundle('\app\assets\AppAsset');

# Javascript and CSS varibles
$jsReady = '';
$jsHead = '';
$css = '';

# Title
// "Application name | Catchphrase" or "Page title | Catchphrase | Application name"
$this->title .= ($this->title ? ' | ': '').Yii::$app->name.(!$this->title ? ' | '.Yii::$app->getParameter('app.catchphrase') : '');

# CSS
// Corpus (generated with php to be shared with admin with colorisation.)
$this->registerLinkTag(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => \yii\helpers\Url::to(['/site/corpus'])]);

// Dynamic colorization
$p = Yii::$app->palette;
// css/views/layouts/main.css
$css = '
body { background-color: '.$p->get('Gray', 90).'; }
.navbar { background: '.$p->get('Gray', -50).'; }
.navbar button { color: '.$p->get('Gray', -50).'; background: '.$p->get('Gray', 70).'; }
.navbar button:hover { background: '.$p->get('Gray', 85).';  }
.navbar button:active, .navbar button[aria-expanded=true] { background: white; }
.navbar-brand svg path { fill: '.$p->get('Gray', 70).'; }
.navbar-brand svg path:last-of-type { fill: '.$p->get('Gray', -60).'; }
.navbar-brand svg rect { fill: '.$p->get('Gray', 70).'; }
.navbar-brand:hover svg rect { fill: '.$p->get('Gray', 85).'; }
.navbar-brand:active svg rect { fill: white; }
@media (max-width: 767px) {
.navbar-right { border-color: '.$p->get('Gray', -30).'; }
}
#footer { color: '.$p->get('Gray', 40).'; background: '.$p->get('Gray', -20).'; }
#footer a { color: '.$p->get('Gray', 40).'; }
#footer hr, #footer ul { border-color: '.$p->get('Gray', 10).'; }
#footer .btn { color: '.$p->get('Gray', -20).'; background: '.$p->get('Gray', 40).'; }
#footer .btn:hover { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 85).'; }
#footer .btn:active { background: white; }
#footer .breadcrumb { color: '.$p->get('Gray', -20).'; background: '.$p->get('Gray', 40).'; }
#footer .breadcrumb a, .windowToTop { color: '.$p->get('Gray', -20).'; }
#footer .breadcrumb a:hover, .windowToTop:hover { color: '.$p->get('Gray', -50).'; }
#footer .breadcrumb a:active, .windowToTop:active { color: white; }
.label { color: '.$p->get('Gray', -50).'; background: '.$p->get('Gray', 85).'; }
.btn.active, .btn[aria-describedby] { color: white !important; background: '.$p->get('BrandPrimary').' !important; }
.jumbotron h1 { color: '.$p->get('BrandPrimary').'; }
';

// @yiingine/modules/media/components/widgets/assets/thumbnail/modal.css
$css .= '
.thumbnail header * { color: '.$p->get('Gray', -20).'; }
.thumbnail .description *, .thumbnail p { color: '.$p->get('Gray').'; }
.thumbnail .btn { color: '.$p->get('Gray').'; background: '.$p->get('Gray', 80).'; }
.thumbnail .btn:hover { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 90).'; }
.thumbnail .btn:active { background: white; }
';

// @yiingine/modules/media/components/widgets/assets/thumbnail/modal.css
$css .= '
.modal header * { color: '.$p->get('Gray', -20).'; }
.modal .content *, .modal p { color: '.$p->get('Gray').'; }
.modal .btn { color: '.$p->get('Gray').'; background: '.$p->get('Gray', 80).'; }
.modal .btn:hover { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 90).'; }
.modal .btn:active { background: white; }
';

// css/menus/mainMenu.css
$css .= '
.mainMenu li a, .mainMenu li a:focus { color: '.$p->get('Gray', 70).'; background: transparent; }
.mainMenu li a:hover, .mainMenu li.active a:hover, .mainMenu li.open a:hover, .mainMenu li.disabled a:hover { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 85).'; }
.mainMenu li a:active, .mainMenu li.active a:active, .mainMenu li.open a:active { background: white; }
.mainMenu li.open a, .mainMenu li.open a:focus { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 85).'; }
.mainMenu li.active a { color: white; background: '.$p->get('BrandPrimary').'; }
.mainMenu li.disabled a, .mainMenu li.disabled a:focus, .mainMenu li.disabled a:hover, .mainMenu li.disabled a:active { color: '.$p->get('Gray', 20).'; }
.mainMenu .dropdown-menu { background: '.$p->get('Gray', 95).'; }
.mainMenu .dropdown-menu li a, .mainMenu .dropdown-menu li a:focus { color: '.$p->get('Gray', -20).'; background: transparent; }
.mainMenu .dropdown-menu li a:hover, .mainMenu .dropdown-menu li.active a:hover, .mainMenu .dropdown-menu li.open a:hover { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 80).'; }
.mainMenu .dropdown-menu li a:active, .mainMenu .dropdown-menu li.active a:active, .mainMenu .dropdown-menu li.open a:active { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 60).'; }
.mainMenu .dropdown-menu li.open a, .mainMenu .dropdown-menu li.open a:focus { color: '.$p->get('Gray', -30).'; background: '.$p->get('Gray', 30).'; }
.mainMenu .dropdown-menu li.active a { color: white; background: '.$p->get('BrandPrimary').'; }
.mainMenu .dropdown-menu li.disabled a, .mainMenu .dropdown-menu li.disabled a:focus, .mainMenu .dropdown-menu li.disabled a:hover, .mainMenu .dropdown-menu li.disabled a:active { color: '.$p->get('Gray', 60).'; }
.mainMenu .dropdown-header { color: '.$p->get('Gray', 10).'; }
.mainMenu .divider { background-color: '.$p->get('Gray', 80).'; }
@media (max-width: 767px) {
.mainMenu .open .dropdown-menu { background: '.$p->get('Gray', -70).'; }
.mainMenu .dropdown-menu li a, .mainMenu .dropdown-menu li a:focus { color: '.$p->get('Gray', 50).'; background: transparent; }
.mainMenu .dropdown-menu li a:hover, .mainMenu .dropdown-menu li.active a:hover, .mainMenu .dropdown-menu li.open a:hover { color: '.$p->get('Gray', 70).'; background: '.$p->get('Gray', -80).'; }
.mainMenu .dropdown-menu li a:active, .mainMenu .dropdown-menu li.active a:active, .mainMenu .dropdown-menu li.open a:active { color: '.$p->get('Gray', 80).'; background: black; }
.mainMenu .dropdown-menu li.open a, .mainMenu .dropdown-menu li.open a:focus { color: '.$p->get('Gray', -30).'; background: '.$p->get('Gray', 30).'; }
.mainMenu .dropdown-menu li.active a { color: white; background: '.$p->get('BrandPrimary').'; }
.mainMenu .dropdown-header { color: '.$p->get('Gray', 10).'; }
.mainMenu .divider { background-color: '.$p->get('Gray', -30).'; }
}
';
// css/menus/footerMenu.css
$css .= '
#footer .footerMenu li a, #footer #footer .footerMenu li a:focus { color: '.$p->get('Gray', 40).'; background: transparent; }
#footer .footerMenu li a:hover, #footer .footerMenu li.active a:hover, #footer .footerMenu li.open a:hover, #footer .footerMenu li.disabled a:hover { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 85).'; }
#footer .footerMenu li a:active, #footer .footerMenu li.active a:active, #footer .footerMenu li.open a:active { background: white; }
#footer .footerMenu li.open a, #footer .footerMenu li.open a:focus { color: '.$p->get('Gray', -60).'; background: '.$p->get('Gray', 85).'; }
#footer .footerMenu li.active a { color: '.$p->get('Gray', -20).'; background: '.$p->get('Gray', 40).'; }
';

//@yiingine/components/widgets/assets/overlay/overlay.css
$css .= '
.overlay:before { background: '.$p->get('BrandPrimary').'; }
';


# JavaScript
/*// Window load behaviour
$jsReady .= '
$(window).load(function()
{
    if(typeof indexResize == "function"){ indexResize(); }
});';
// Window scroll behaviour
$jsReady .= '
$(window).scroll(function()
{
    if(typeof indexScrolling == "function"){ indexScrolling(); }
    displayPictoGoUp();
});';
// Window resize behaviour
$jsReady .= '
$(window).resize(function()
{
    if(typeof indexResize == "function"){ indexResize(); }
});';
 * 
 */

# JAVASCRIPT AND CSS REGISTERING
$this->registerJs($jsHead, View::POS_HEAD);
$this->registerJs($jsReady, View::POS_READY);
$this->registerCss($css, ['media' => 'screen']);
