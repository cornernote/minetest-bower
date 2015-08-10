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

    public function actionImportMtpm()
    {
        $nameTranslate = [
            'Crops' => 'crops',
        ];
        $urlTranslate = [
            '/archive/master.zip.git' => '.git',
            '/archive/1.13.zip.git' => '.git',
            '/issues.git' => '.git',
            '/zipball/master.git' => '.git',
            '/archive-tarball/master.git' => '.git',
            'https://repo.or.cz/' => 'http://repo.or.cz/',
        ];
        $csv = array_map('str_getcsv', explode("\n", file_get_contents('https://raw.githubusercontent.com/rubenwardy/mtpm_lists/gh-pages/lists/mods.csv')));
        array_shift($csv);
        foreach ($csv as $row) {
            if (!isset($row['1'])) {
                continue;
            }
            $name = trim($row['1']);
            if (in_array($name, array_keys($nameTranslate))) {
                $name = $nameTranslate[$name];
            }
            $url = trim(trim($row['2'], '/')) . '.git';
            $url = strtr($url, $urlTranslate);
            if (!strpos($url, 'github.com') && !strpos($url, 'bitbucket.org') && !strpos($url, 'repo.or.cz')) {
                continue;
            }
            $package = Package::find()->where(['name' => $name])->one();
            if (!$package) {
                $package = new Package();
                $package->name = $name;
            } else {
                $package->checkUrl = false;
            }
            if (!$package->url)
                $package->url = $url;
            if (!$package->homepage)
                $package->homepage = trim($row['4']);
            if (!$package->authors)
                $package->authors = [trim($row['0'])];
            $package->save();
        }
    }

}
