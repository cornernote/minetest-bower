<?php
require(__DIR__ . '/../../vendor/autoload.php');

if (file_exists(__DIR__ . '/../../.env'))
    (new \Dotenv\Dotenv(__DIR__ . '/../..'))->load();

defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') ? (getenv('YII_DEBUG') == 'false' ? false : getenv('YII_DEBUG')) : true);
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ? getenv('YII_ENV') : 'dev');