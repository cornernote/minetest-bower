<?php

if (YII_ENV == 'prod') {
    $url = parse_url(getenv('DATABASE_URL'));
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'pgsql:host=' . $url['host'] . ';dbname=' . substr($url['path'], 1),
        'username' => $url['user'],
        'password' => $url['pass'],
        'charset' => 'utf8',
    ];
}
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=minetest_bower',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
