<?php

require '../app/vendor/autoload.php';

$app = new \Slim\Slim();

require '../app/config.php';
require '../app/data/config.php';
require '../app/routes/default.php';
require '../app/routes/packages.php';

$app->run();

?>