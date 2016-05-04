<?php
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

// YII MODE
// Set the application to development mode.
defined('YII_ENV') or define('YII_ENV', 'dev');
// Set the application to production mode.
// defined('YII_ENV') or define('YII_ENV', 'prod');

// DB LOCATION
// Use the production database.
//defined('DB_LOCATION') or define('DB_LOCATION', 'production');
// Use the remote database.
//defined('DB_LOCATION') or define('DB_LOCATION', 'remote');
// Use the local database.
defined('DB_LOCATION') or define('DB_LOCATION', 'local');

if(YII_ENV === 'dev')
{
    defined('YII_DEBUG') or define('YII_DEBUG', true); // Set YII_DEBUG in php.
}
else // Yiingine is in production mode.
{
    defined('YII_DEBUG') or define('YII_DEBUG', false); // Set YII_DEBUG in php.
}

date_default_timezone_set('Europe/Paris');

$config = [
    'id' => 'application_name',
    'name' => 'Application Name',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'insertYourValidationKey',
        ],
        'cache' => [
             //'class' => 'yii\caching\FileCache',
             'class' => 'yii\caching\DummyCache' // Uncomment to disable caching.
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [],
        'palette' => [
            'class' => '\yiingine\components\Palette',
            'colors' => [
                'Gray' => '#787878',
                'BrandPrimary' => '#0f8333', // to replace recursively
            ]
        ],
        'view' => [
            'siteTheme' => 'slate',
            'availableSiteThemes' => [
                'base' => '\app\themes\base\Theme',
                'lumen' => '\app\themes\lumen\Theme',
                'slate' => '\app\themes\slate\Theme'
            ],
            'adminTheme' => 'slate',
            'availableAdminThemes' => [
                'base' => '\yiingine\themes\admin\base\Theme',
                'lumen' => '\app\themes\lumen\Theme',
                'slate' => '\app\themes\slate\Theme'
            ]
        ]
    ],
    'modules' => [
        'users' => [
            'label' => ['en' => 'Users', 'fr' => 'Utilisateurs'],
            'modules' => [
                'rbac' => [
                    'class' => '\yiingine\modules\users\modules\rbac\RbacModule',
                ],
            ],
            'allowRegistration' => true,
            'activeAfterRegister' => false,
            'sendActivationMail' => true, // Needs activeAfterRegister = false
            'allowPasswordRecovery' => true,
            'allowProfileEdition' => true,
            'allowAccountDeletion' => true,
            'allowPublicProfiles' => true,
            'doCaptchaAtRegistration' => true
        ],
        'media' => [
            'cachingLevel' => YII_DEBUG ? 0 : 2, //CacheControlInterface::CACHE_NONE : CacheControlInterface::CACHE_ALL 
            'mediaClasses' => [
                'app\modules\media\models\Index',
                'app\modules\media\models\Page',
                'app\modules\media\models\Image',
                'app\modules\media\models\Video',
                'app\modules\media\models\Gallery',
                'app\modules\media\models\Insert',
                'app\modules\media\models\Document'
            ],
        ],
        'search' => [
            'class' => '\yiingine\modules\searchEngine\Module',
            'components' => [
                'searchEngine' => [
                    'class' => 'yiingine\modules\searchEngine\base\SearchEngine',
                    'models' => [
                        '\app\modules\media\models\Index',
                        '\app\modules\media\models\Page',
                    ]
                ]
            ]
        ],
        'adminSiteToolbar' => ['class' => '\yiingine\modules\adminSiteToolbar\Module']
    ],
    'params' => [        
        'app.available_languages' => ['fr', 'en'],
        'app.supported_languages' => ['fr', 'en'],
        'enable_auth_management' => true
    ],
];

/* Give the option of using a variable to retrieve the database connection string so code
 * including this file can know at runtime what the other database configurations are. */
if(!isset($dbLocation))
{
    $dbLocation = DB_LOCATION;
}

require 'db.php';

if(YII_ENV === 'dev') 
{
    // Configuration adjustments for 'dev' environment.
    //$config['bootstrap'][] = 'debug';
    //$config['modules']['debug'] = 'yii\debug\Module';

    /*$config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';*/
}

return $config;
