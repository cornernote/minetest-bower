<?php

require(__DIR__ . '/../src/config/init.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../src/config/bootstrap.php');
$config = require(__DIR__ . '/../src/config/main.php');
(new yii\web\Application($config))->run();