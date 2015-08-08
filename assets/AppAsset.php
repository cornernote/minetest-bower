<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/web';
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/slate/bootstrap.min.css',
        'css/site.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
