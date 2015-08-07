<?php

defined('YII_ENV') or define('YII_ENV', 'dev');

$config = [
    'id' => 'minetest-bower',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => getenv('APP_COOKIE_VALIDATION_KEY') or 'test',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'POST packages' => 'package/create',
                'packages' => 'package/index',
                'packages/search/<name:\w+>' => 'package/search',
                'packages/<name:\w+>' => 'package/view',
            ],
        ],
    ],
];

return $config;
