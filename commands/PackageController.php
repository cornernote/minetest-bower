<?php

namespace app\commands;

use app\components\Git;
use app\models\Package;
use Yii;
use yii\console\Controller;

class PackageController extends Controller
{

    public function actionUpdateBower()
    {
        $packages = Package::find()->all();
        foreach ($packages as $package) {
            $package->bower = Git::get($package->url, 'bower.json');
            $package->save();
        }
    }

}
