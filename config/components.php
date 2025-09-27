<?php

$urlManager = require __DIR__ . '/url_manager.php';
$assetManager = require __DIR__ . '/asset_manager.php';

return [
    'assetManager' => $assetManager,
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => CSFR_VALIDATION_KEY,
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'app\modules\user\models\User',
        'enableAutoLogin' => true,
        'loginUrl' => ['/user/user/login']
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => \yii\symfonymailer\Mailer::class,
        'viewPath' => '@app/mail',
        // send all mails to a file by default.
        'useFileTransport' => YII_ENV_DEV ? true : false,
        'transport' => MAIL_TRANSPORT
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
    'db' => DB_CONFIG,
    'urlManager' => $urlManager
];
