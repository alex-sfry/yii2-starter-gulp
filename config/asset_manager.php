<?php

return [
    // 'converter' => [
    //     'class' => 'yii\web\AssetConverter',
    //     'commands' => [],
    // ],
    'appendTimestamp' => true,
    // 'linkAssets' => true,
    // 'forceCopy' => YII_DEBUG,
    'bundles' => [
        'yii\web\JqueryAsset' => [
            'basePath' => '@webroot',
            'baseUrl' => '@web',
            'js' => [YII_ENV_PROD ? 'dist/js/jquery.min.js' :  'src/js/jquery.min.js']
        ],
        'yii\bootstrap5\BootstrapAsset' => [
            'basePath' => '@webroot',
            'baseUrl' => '@web',
            'css' => [YII_ENV_PROD ? 'dist/css/bootstrap.min.css' : 'src/css/bootstrap.css'],
        ],
        'yii\bootstrap5\BootstrapPluginAsset' => [
            'basePath' => '@webroot',
            'baseUrl' => '@web',
            'js' => [YII_ENV_PROD ? 'dist/js/bootstrap.min.js' : 'src/js/bootstrap.dev.js'],
        ]
    ]
];
