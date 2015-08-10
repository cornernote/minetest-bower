<?php

namespace app\commands;

use app\components\Git;
use app\models\Package;
use Yii;
use yii\console\Controller;

class PackageController extends Controller
{

    public function actionUpdate()
    {
        $packages = Package::find()->all();
        foreach ($packages as $package) {
            $package->harvestModInfo();
            if ($package->getDirtyAttributes()) {
                $package->save();
            }
        }
    }

}
