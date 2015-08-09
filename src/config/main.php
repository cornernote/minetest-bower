<?php
use yii\helpers\ArrayHelper;

$config = [
    'id' => 'minetest-bower',
    'name' => 'Minetest Bower',
    'basePath' => dirname(__DIR__),
    'vendorPath' => '@app/../vendor',
    'runtimePath' => '@app/../runtime',
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
                // packages
                'POST packages' => 'package/create',
                'packages/search/<name:\w+>' => 'package/search',
                'packages/<name:\w+>' => 'package/view',
                'packages' => 'package/index',
                // mods
                'mods/update/<name:\w+>' => 'mod/update',
                'mods/<name:\w+>' => 'mod/view',
                'mods' => 'mod/index',
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

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;