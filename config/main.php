<?php
use yii\helpers\ArrayHelper;

$config = [
    'id' => 'minetest-bower',
    'name' => 'Minetest Bower',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
    ],
];

$web = [
    'components' => [
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

$console = [
    'controllerNamespace' => 'app\commands',
];

if (php_sapi_name() != 'cli') {
    // Web application
    $config = ArrayHelper::merge($config, $web);
} else {
    // Console application
    $config = ArrayHelper::merge($config, $console);
}

return $config;