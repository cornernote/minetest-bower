<?php

ActiveRecord\Config::initialize(function($cfg) use ($config) {
    $database = $config['database'];    
    $cfg->set_model_directory($database['models']);
    $cfg->set_connections($database['connection']);
});

?>