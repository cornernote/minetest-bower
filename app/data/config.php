<?php

ActiveRecord\Config::initialize(function($cfg) use ($config) {
    $database = $config['database'];    
    $cfg->set_model_directory($database['models']);
    $cfg->set_connections($database['connection']);
    $cfg->set_default_connection(getenv('APP_ENV') ? getenv('APP_ENV') : 'development');
});
