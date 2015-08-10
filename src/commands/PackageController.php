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
        $ignore = [
            'lulzpack',
            'lift',
            'Animalsmod',
            'admin_tools',
            'extrachests',
            'bettercoal',
            'slabrealm',
            'mccarpet',
            'clock',
            'helicopter',
            'mudslide',
            'beacon',
            'books_plus',
            'nyancats_plus',
            'realclocks',
            'Marble_Blocks',
            'chests_0gb_us',
            'kerova',
            'chatlog',
            'airship',
            'treasurer',
            'alphabet',
            'DOM-modpack-all',
            'whereis',
            'fireworks',
            'components',
            'senderman',
            'glowcrystals',
            'magic_latern',
            'mod3',
            'greenscreens',
            'creative',
            'digicode',
            'armor',
            'xray',
            'octublock',
            'mudslide',
            'secret',
            'no_guests',
            'papyrus_door',
            'terror',
            'mblocks',
            'uranium',
            'fishing',
            'bigchests',
            'signs',
            'future_ban',
            'candles',
            'birthstones',
            'camomod',
            'chains',
            'docfarming',
            'drippingwater',
            'oneclick',
            'my_mobs',
            'mint',
            'cgmr',
            'watch',
            'workbench',
            'noncubic',
            'nuke',
            'weblock',
            'sea',
            'bedrock',
            'bones',
            'gauges',
            'hovers',
            'itemframes',
            'item_drop',
            'names_per_ip',
            'paintings',
            'snow',
            'flint',
            'camouflage',
            'glowstone',
            'diamond_fist',
            'mines',
            'mailbox',
            'jukebox',
            'altertrunks',
            'thaumtest',
            'blox',
            'bone',
            'crafting',
            'dplus',
            'fences',
            'compass',
            'sethome',
            'xfences',
            'camo_modpack',
            'painting',
            'tbm',
            'brillantblocks',
            'flags',
            'gems',
            'infinitytools',
            'lavacooling',
            'chat_channel',

            // gitorious
            'building_blocks',
            'desert_uses',
        ];
        $nameTranslate = [
            'Crops' => 'crops',
        ];
        $urlTranslate = [
            '/archive/master.zip.git' => '.git',
            '/archive/1.13.zip.git' => '.git',
            '/issues.git' => '.git',
            '/zipball/master.git' => '.git',
            '/archive-tarball/master.git' => '.git',
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
            if (in_array($name, $ignore)) {
                continue;
            }
            $url = trim(trim($row['2'], '/')) . '.git';
            $url = strtr($url, $urlTranslate);
            $package = Package::find()->where(['name' => $name])->one();
            if (!$package) {
                $package = new Package();
                $package->name = $name;
            } else {
                $package->checkUrl = false;
            }
            $package->url = $url;
            $package->homepage = trim($row['4']);
            $package->authors = [trim($row['0'])];

            //$package->checkUrl = false;
            if (!$package->save()) {
                print_r($package->errors);
                print_r($package->attributes);
                die;
            }
        }
    }

}
