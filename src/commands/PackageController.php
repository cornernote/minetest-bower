<?php

namespace app\commands;

use app\components\Git;
use app\models\Package;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class PackageController extends Controller
{

    public function actionUpdate()
    {
        $packages = Package::find()->all();
        $this->stdout('Updating mods from repositories' . "\n");
        $count = count($packages);
        foreach ($packages as $k => $package) {
            $this->stdout('[' . ($k + 1) . '/' . $count . '] ', Console::FG_GREY);
            $this->stdout($package->name . ' ' . $package->url . ': ');
            $package->harvestModInfo();
            if ($package->getDirtyAttributes()) {
                if ($package->save()) {
                    $this->stdout('Updated!' . "\n", Console::FG_GREEN);
                } else {
                    $this->stdout('Errors', Console::FG_RED);
                    foreach ($package->errors as $attribute => $errors) {
                        $this->stdout(' -- ' . $attribute . ' ' . implode(', ', $errors), Console::FG_RED);
                    }
                    $this->stdout("\n");
                }
            } else {
                $this->stdout('Unchanged.' . "\n", Console::FG_PURPLE);
            }
        }
    }

    public function actionImportMtpm()
    {
        $file = 'https://raw.githubusercontent.com/rubenwardy/mtpm_lists/gh-pages/lists/mods.csv';
        $this->stdout('Importing MTPM from ' . $file . "\n");
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
        $csv = array_map('str_getcsv', explode("\n", trim(file_get_contents($file))));
        array_shift($csv);
        $count = count($csv);
        foreach ($csv as $k => $row) {
            $this->stdout('[' . ($k + 1) . '/' . $count . '] ', Console::FG_GREY);
            if (!isset($row['1'])) {
                continue;
            }
            $name = trim($row['1']);
            if (in_array($name, array_keys($nameTranslate))) {
                $name = $nameTranslate[$name];
            }
            $url = trim(trim($row['2'], '/')) . '.git';
            $url = strtr($url, $urlTranslate);
            $this->stdout($name . ' ' . $url . ': ');
            if (!strpos($url, 'github.com') && !strpos($url, 'bitbucket.org') && !strpos($url, 'repo.or.cz')) {
                $this->stdout('Not on allowed git list, skipping.' . "\n", Console::FG_YELLOW);
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
            if (!$package->forum)
                $package->forum = trim($row['4']);
            if (!$package->authors)
                $package->authors = [trim($row['0'])];
            if ($package->save()) {
                $this->stdout('Saved!' . "\n", Console::FG_GREEN);
            } else {
                $this->stdout('Errors', Console::FG_RED);
                foreach ($package->errors as $attribute => $errors) {
                    $this->stdout(' -- ' . $attribute . ' ' . implode(', ', $errors), Console::FG_RED);
                }
                $this->stdout("\n");
            }
        }
    }

}
