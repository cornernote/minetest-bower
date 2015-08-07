<?php

// CONFIG
$url = parse_url(getenv('DATABASE_URL'));
$config = array(
    'database' => array(
        'models' => '../app/models',
        'connection' => array(
            'production' => 'pgsql://' . $url['user'] . ':' . $url['pass'] . '@' . $url['host'] . '/' . substr($url['path'], 1)',
            'development' => 'sqlite://../app/data/bower.db.sqlite',
        ),
    ),
);