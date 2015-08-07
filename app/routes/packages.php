<?php

// process
// Porcess a phpactiverecord recordset
$process = function ($packages) {

    // attributes
    // Return require attributes from record
    function attributes ($pkg) {

        return array(
            'name' => $pkg->name,
            'url' => $pkg->url
        );

    };

    $results = null;

    if (isset($packages)) { 

        $results = array();

        if (is_array($packages)) {

            foreach ($packages as $package) {
                array_push($results, attributes($package));
            }

        } else {
            $results = attributes($packages);
        }

        $results = json_encode($results);

    }

    return $results;

};

// POST /packages
// > Accept: application/json
// 
//      {
//          name: 'package-name',
//          url: 'git-url'
//      }
//
// < 200

$app->post('/packages', function () use ($app) {

    $attributes = $app->request()->post();
    $package = new Package(array(
        'name' => $attributes['name'],
        'url' => $attributes['url']
    ));
    if ($package->is_valid()) {
        $package->save();
        $app->response()->status(201);
    } else {
        $app->response()->status(400);
    }

});

// GET /packages
// < 200
// < Content-Type: application/json
// 
//      [{
//          name: 'package-name',
//          url: 'git-url'
//      }]

$app->get('/packages', function () use ($app, $process) {

    $result = $process(Package::find('all', array('order' => 'name DESC')));

    if (isset($result)) {
        $app->response()->header('Content-Type', 'application/json');
        echo $result;
    }

});

// GET /packages/{parameters}
// < 200
// < Content-Type: application/json
// 
//      {
//          name: 'package-name',
//          url: 'git-url'
//      }

$app->get('/packages/:name', function ($name) use ($app, $process) {

    $package = Package::find(array('conditions' => array('name = ?', $name)));
    $result = $process($package);

    if (isset($result)) {

        $package->update_attributes(array('hits' => $package->hits + 1));
        $app->response()->header('Content-Type', 'application/json');
        echo $result;

    } else {
        $app->response()->status(404);
    }

});

// GET /packages/search/{parameters}
// < 200
// 
//      [{
//          name: 'package-name',
//          url: 'git-url'
//      }]

$app->get('/packages/search/:name', function ($name) use ($app, $process) {

    $packages = Package::find('all', array('conditions' => array('name LIKE "%' . $name . '%"'), 'order' => 'name DESC'));
    $result = $process($packages);

    if (isset($result)) {
        $app->response()->header('Content-Type', 'application/json');
        echo $result;
    }

});

?>