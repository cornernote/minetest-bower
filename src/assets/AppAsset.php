<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/web';
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css',
        'https://cdn.rawgit.com/google/code-prettify/master/styles/desert.css',
        'css/site.css',
    ];
    public $js = [
        'https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
