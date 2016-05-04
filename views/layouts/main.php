<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

use \yii\helpers\Html;
use \yii\helpers\Url;
use \yii\web\View;
use rmrevin\yii\fontawesome\FA;
use \yiingine\modules\media\models\Medium;
use \yiingine\models\MenuItem;
use \yiingine\widgets\admin\AdminOverlay;
use \yiingine\widgets\FlashMessage;

$this->beginContent('@yiingine/views/layouts/main.php');

\yiingine\modules\adminSiteToolbar\widgets\Toolbar::begin();

# Header & Navigation ?>
<nav id="navbar" class="navbar navbar-fixed-top">
    <div id="flash-messages">
        <?php
        echo \yiingine\widgets\FlashMessage::display();
        // Sets the correct body padding when the height of the navbar changes.
        $this->registerJs(
            'function mainUpdateBodyPaddingTop() { $("body").css({paddingTop : $("#navbar").height()-parseInt($("#content").css("padding-top")) }); }'
            .'function flashMessageToogleOnClick(button){ for(i=0;i<=250;i++){ if(isInt(i/10)) setTimeout(function(){ mainUpdateBodyPaddingTop(); $(window).trigger("resize"); }, i); } }'
            .'function flashMessageCloseOnClick(button){ mainUpdateBodyPaddingTop(); $(window).trigger("resize"); }'
        , View::POS_HEAD);
        $this->registerJs(
            'mainUpdateBodyPaddingTop();'
        , View::POS_READY);
        ?>
    </div>
    <div class="container">
        <div class="navbar-header">
        <?php // Brand (Main logo) ?>
        <?php if(Yii::$app->getParameter('app.main_logo_reduced', false)): ?>
            <a class="navbar-brand visible-xs visible-sm" href="<?php echo Url::to(['/']); ?>" title="<?php echo Yii::$app->name; ?>" rel="home"><?php include('user/assets/'.Yii::$app->params['app.main_logo_reduced']); ?></a>
            <?php
            AdminOverlay::widget([
                'selector' => '.navbar-brand.visible-sm svg',
                'url' => Url::to(['/admin/default/site']), // !!! : À Compléter
                'options' => ['style' => 'z-index:1030;position:fixed;'],
                'displayRule' => '$(".navbar-brand.visible-sm").is(":visible");',
            ]);
            ?>
        <?php endif; ?>
        <?php if(Yii::$app->getParameter('app.main_logo', false)): ?>
            <a class="navbar-brand hidden-xs hidden-sm" href="<?php echo Url::to(['/']); ?>" title="<?php echo Yii::$app->name; ?>" rel="home"><?php include('user/assets/'.Yii::$app->params['app.main_logo']); ?></a>
            <?php
            AdminOverlay::widget([
                'selector' => '.navbar-brand.hidden-sm svg',
                'url' => Url::to(['/admin/default/site']), // !!! : À Compléter
                'options' => ['style' => 'z-index:1030;position:fixed;'],
                'displayRule' => '$(".navbar-brand.hidden-sm").is(":visible");',
            ]);
            ?>
        <?php endif; ?>
        </div>
        <div class="navbar-header pull-right">
            <?= // Login box
            $this->renderDynamic('return \yiingine\modules\users\widgets\LoginBox::widget([
                "switchType"=> \yiingine\modules\users\widgets\LoginBox::DROPDOWN
            ]);'); // renderDynamic() is used because the login box varies depending on the logged in user.
            ?>
            <?= // Language box
            \yiingine\widgets\LangBox::widget([
                'displayMode' => \yiingine\widgets\LangBox::CODE,
                'switchType' => \yiingine\widgets\LangBox::DROPDOWN
            ]);
            ?>
            <?= // Search box
            \yiingine\modules\searchEngine\widgets\SearchBox::widget();
            ?>
            <?php // Toggle navigation ?>
            <button type="button" class="navbar-toggle collapsed btn" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <?= FA::icon('navicon'); ?>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <?php # Main menu
            echo \yiingine\widgets\DBMenu::widget([
                'menuName' => 'mainMenu',
                'menuOptions' => ['class' => 'nav navbar-nav navbar-left'], // Bootstrap navbar
                'listOptions' => ['class' => 'dropdown-menu'], // Bootstrap dropdown menu
                //'cache' => !YII_DEBUG,
                'listItemBeginRendering' => function($options, $depth, $current)
                {
                    echo Html::beginTag('li', $options);
                },
                'menuItemRendering' => function($text, $url, $options, $depth, $current)
                {
                    // If this current menu item has a child.
                    if($current->displayedMenuItems)
                    {
                        // Bootstrap dropdown attributes
                        $options['class'] = 'dropdown-toggle';
                        $options['aria-expanded'] = 'false';
                        $options['role'] = 'button';
                        $options['data-toggle'] = 'dropdown';
                        // Add an arrow after the text.
                        $text .= Html::tag('span', '', ['class' => 'caret']);
                    }
                    echo Html::a($text, $url, $options); // Echo a link tag.
                },
                // Add extra menu items after the existing menu nodes.
                'afterNodes' => [
                    // Simple menu item and sub menu items.
                    new MenuItem([
                        'name' => 'Links',
                        'name_fr' => 'Liens',
                        'route' => Url::to(['/']),
                        'displayed' => true,
                        'enabled' => true,
                        'menuItems' => [
                            new MenuItem(['name' => 'Yii', 'name_fr' => 'Yii', 'enabled' => true, 'displayed' => true, 'route' => 'http://yiisoft.com']),    
                            new MenuItem(['name' => 'PHP', 'name_fr' => 'PHP', 'enabled' => true, 'displayed' => true, 'route' => 'http://php.net']),
                        ],
                    ]),
                    // Disabled menu item and sub menu item.
                    new MenuItem([
                        'name' => 'Disabled',
                        'name_fr' => 'Désactivé',
                        'route' => Url::to(['/']),
                        'displayed' => true,
                        'enabled' => false,
                        'menuItems' => [
                            new MenuItem(['name' => 'Forbidden', 'name_fr' => 'Interdit', 'enabled' => false, 'displayed' => true, 'route' => Url::to(['/'])]),    
                        ],
                    ])
                ]
            ]);
            AdminOverlay::widget([
                'selector' => '#navbar .mainMenu',
                'url' => Url::to(['/admin/menus']), // !!! : À Compléter (MenuItem[parent_id]/1)
                'options' => ['style' => 'z-index:1030;position:fixed;'],
                'displayRule' => '$(".navbar-toggle").is(":hidden");',
            ]);
            ?>
        </div>
    </div>
</nav>

<?php # Content (use of .wrapper and .push for .stickyFooter) ?>
<div id="content" class="wrapper">
    <?= $content; ?>
    <div class="push"></div>
</div>
<?php # Footer (sticky) ?>
<div id="footer" class="stickyFooter">
    <div class="container">
        <div class="breadcrumbWrapper">
            <?php 
            echo \yii\widgets\Breadcrumbs::widget([
                'tag' => 'ol',
                'options' => ['class' => 'breadcrumb'],
                'itemTemplate' => '<li>{link}</li>',
                'activeItemTemplate' => '<li class="active">{link}</li>',
                'homeLink' => false, // Home link is included with links so it's always diplayed.              
                'links' => array_merge([[
                    'label' => Yii::$app->name, 
                    'url' => ['/'],
                    'rel' => 'home'
                ]], isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs']: []),
            ]);
            ?>
            <span class="windowToTop" onclick="$('body, html').animate({scrollTop:0}, 500);"><?= FA::icon('arrow-up'); ?></span>
        </div>
        <div class="row row-eq-height">
            <div class="col col-sm-1">
                <?php 
                // Brand logo
                if(Yii::$app->getParameter('app.brand_logo', false))
                {
                    echo Html::img(Yii::$app->request->baseUrl.'/user/assets/'.Yii::$app->getParameter('app.brand_logo'), [
                        'id'=>'brandLogo',
                        'class'=>'img-circle img-responsive center-block'
                    ]);
                    AdminOverlay::widget([
                        'selector' => '#brandLogo',
                        'url' => Url::to(['/admin/default/site']), // !!! : À Compléter
                    ]);
                }
                ?>
                <?=
                // vCard download link
                Html::a(FA::icon('bookmark'), Url::to(['/site/address.getVCard',
                    'lastName' => Yii::$app->getParameter('app.owner_last_name', ''),
                    'firstName' => Yii::$app->getParameter('app.owner_name', ''),
                    'street' => Yii::$app->getParameter('app.owner_street', ''),
                    'city' => Yii::$app->getParameter('app.owner_city', ''),
                    'postalCode' => Yii::$app->getParameter('app.owner_postal_code', ''),
                    'country' => Yii::$app->getParameter('app.owner_country', ''),
                    'email' => Yii::$app->getParameter('app.owner_email1', ''),
                    'organisation' => Yii::$app->getParameter('app.brand_name', ''),
                    //'title' => $model->partner_role,
                    'phone' => Yii::$app->getParameter('app.owner_telephone1', ''),
                    //'url' => urlencode('test.com'),
                    'photo' => urlencode('/user/assets/'.Yii::$app->getParameter('app.brand_logo')),
                ]), ['class' => 'getVCard btn center-block', 'title'=>Yii::tA(['en' => 'Add to my contacts', 'fr' => 'Ajouter à mes contacts'])]);
                ?>
            </div>
            <div class="col col-sm-3">
                <?=
                // Address
                \yiingine\widgets\Microformats::widget([
                    'organization' => Yii::$app->getParameter('app.brand_name', ''),
                    'firstName' => Yii::$app->getParameter('app.owner_name', ''),
                    'lastName' => Yii::$app->getParameter('app.owner_last_name', ''),
                    'addresses' => [
                        [
                            'streetAddress' => Yii::$app->getParameter('app.owner_street', ''),
                            'postalCode' => Yii::$app->getParameter('app.owner_postal_code', ''),
                            'locality' => Yii::$app->getParameter('app.owner_city', ''), // (city)
                            'countryName' => Yii::$app->getParameter('app.owner_country', '')
                        ]
                    ],
                    'phoneNumbers' => [
                        [
                            'type' => 'home',
                            'value' => Yii::$app->getParameter('app.owner_telephone1', ''),
                            'label' => Yii::tA(['en' => 'Home', 'fr' => 'Fixe']).' : ',
                            'hiddenMessage' => Yii::tA(['en' => 'Display home phone number', 'fr' => 'Afficher numéro de téléphone fixe']),
                        ],
                        [
                            'type' => 'work',
                            'value' => Yii::$app->getParameter('app.owner_telephone2', ''),
                            'label' => Yii::tA(['en' => 'Office', 'fr' => 'Bureau']).' : ',
                            'hiddenMessage' => Yii::tA(['en' => 'Display office phone number', 'fr' => 'Afficher numéro de téléphone professionel']),
                        ],
                        [
                            'type' => 'fax',
                            'value' => Yii::$app->getParameter('app.owner_fax', ''),
                            'label' => Yii::tA(['en' => 'Fax', 'fr' => 'Fax']).' : ',
                            'hiddenMessage' => Yii::tA(['en' => 'Display fax phone number', 'fr' => 'Afficher numéro de fax']),
                        ]
                    ],
                    'emails' => [
                        [
                            'value' => Yii::$app->getParameter('app.owner_email1', ''),
                            'label' => Yii::tA(['en' => '1st Email', 'fr' => '1er Email']).' : ',
                            'hiddenMessage' => Yii::tA(['en' => 'Display first email', 'fr' => 'Afficher premier email']),
                        ],
                        [
                            'value' => Yii::$app->getParameter('app.owner_email2', ''),
                            'label' => Yii::tA(['en' => '2nd Email', 'fr' => '2e Email']).' : ',
                            'hiddenMessage' => Yii::tA(['en' => 'Display second email', 'fr' => 'Afficher second email']),
                        ],
                    ],
                    'urls' => [
                        [
                            'value' => Yii::$app->getParameter('main_domain', ''),
                            'label' => Yii::tA(['en' => 'Website', 'fr' => 'Site']).' : ',
                        ],
                        [
                            'value' => 'sample.com',
                            'label' => Yii::tA(['en' => 'Blog', 'fr' => 'Blogue']).' : ',
                        ],
                    ]
                ]);
                AdminOverlay::widget([
                    'selector' => '#footer .vcard',
                    'url' => Url::to(['/admin/default/site']), // !!! : À Compléter
                ]);
                ?>
            </div>
            <div class="col col-xs-12 col-sm-4">
                <hr class="visible-xs" />
                <?php
                # Footer menu
                //$this->registerCssFile(Url::to(['/css/menus/footerMenu.css']), ['media' => 'screen']);
                echo \yiingine\widgets\DBMenu::widget([
                    'menuName' => 'footerMenu',
                    'menuOptions' => ['class' => 'nav nav-pills nav-stacked'], // Bootstrap navbar
                ]);
                AdminOverlay::widget([
                    'selector' => '#footer .footerMenu',
                    'url' => Url::to(['/admin/menus']), // !!! : À Compléter (MenuItem[parent_id]/2)
                ]);
                ?>
            </div>
            <div class="col col-xs-12 col-sm-4">
                <hr class="visible-xs" />
                <div class="socialLinks">
                <?php 
                // Social networks
                if(Yii::$app->getParameter('app.social_links', false))
                {
                    echo \yiingine\widgets\SocialLinks::widget([
                        'urls' => Yii::$app->getParameter('app.social_links'),
                        'options' => [
                            'class' => 'btn',
                            'target' => '_blank'
                        ],
                        'networks' => [
                            'sample.com' => [
                                'name' => 'My Super Blog',
                                'icon' => 'heart',
                                'options' => [
                                    'data-color' => 'green'
                                ]
                            ],
                            'youtube.com' => [
                                'icon' => 'youtube-square',
                                'options' => [
                                    'title' => Yii::tA(['en' => 'Visit my YouTube channel !', 'fr' => 'Visitez ma chaîne YouTube !'])
                                ]
                            ],
                        ],
                    ]);
                    $this->registerJs('$(".socialLinks .btn").hover(
                        function(){
                            $(this).css({background:$(this).data("color"),color:"white"});
                        },
                        function(){
                            $(this).removeAttr("style");
                        }
                    );', View::POS_READY);
                    AdminOverlay::widget([
                        'selector' => '#footer .socialLinks',
                        'url' => Url::to(['/admin/default/site']), // !!! : À Compléter
                    ]);
                }
                ?>
                </div>
                <hr class="visible-xs" />
                <?php 
                // Copyright and credits
                if(Yii::$app->getParameter('yiingine.SocialMetas.meta_copyright', false))
                {
                    $copyright = FA::icon('copyright').' '.date('Y').' '.Html::tag('span', Yii::$app->getParameter('yiingine.SocialMetas.meta_copyright'));
                    $credits = Yii::tA([
                        'en' => 'Photos are licensed under the <a href="https://creativecommons.org/licenses/by-sa/4.0/deed.en">Creative Commons Attribution-Share Alike 4.0 International</a>. Thanks to <a href="https://commons.wikimedia.org">Wikipedia Commons</a>.',
                        'fr' => 'Les photos sont sous la license <a href="https://creativecommons.org/licenses/by-sa/4.0/deed.en">Creative Commons Attribution-Share Alike 4.0 International</a>. Remerciements à <a href="https://commons.wikimedia.org">Wikipedia Commons</a>.'
                    ]);
                    echo Html::tag('div', $copyright.'<br />'.$credits, ['class' => 'copyright']);
                    AdminOverlay::widget([
                        'selector' => '#footer .copyright span',
                        'url' => Url::to(['/admin/default/site']), // !!! : À Compléter
                    ]);
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php # Modals ?>

<?= // Login box modal
$this->renderDynamic('return \yiingine\modules\users\widgets\LoginBox::widget([
    "view" => "loginBoxModal"
]);'); // renderDynamic() is used because the login box varies depending on the logged in user.
 ?>
<?= // Search box modal
\yiingine\modules\searchEngine\widgets\SearchBox::widget([
    'view' => 'searchBoxModal',
    'id' => 'searchBoxModal'
]);
?>
<?= // Language box modal
\yiingine\widgets\LangBox::widget([
    'view' => 'langBoxModal'
]);
?>
<?php // Media modal
// If the url contained an argument for the display of a Medium in a modal dialog.
if($id = Yii::$app->request->get('modal'))
{
    $id = (int)$id;
    if(!is_integer($id))
    {
        throw new \yii\web\BadRequestException();
    }
    $model = \yiingine\modules\media\models\Medium::findOne($id);
    // If the model can be accessed by the current user.
    if($model && $model->getEnabled() )//&& $model->isAccessible())
    {
        $modalId = uniqid();
        echo \yiingine\modules\media\components\widgets\Modal::widget([
            'id' => $modalId,
            'model' => $model
        ]);
        $this->registerJs('$("#'.$modalId.'").modal();', \yii\web\View::POS_READY);
        
        if(Yii::$app->has('socialMetas'))
        {
            Yii::$app->socialMetas->title = $model->getTitle();
            Yii::$app->socialMetas->description = $model->getDescription();
            Yii::$app->socialMetas->thumbnail = $model->getThumbnail();
        }
    }
}

\yiingine\modules\adminSiteToolbar\widgets\Toolbar::end();

$this->endContent();
