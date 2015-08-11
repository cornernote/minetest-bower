<?php

namespace app\assets;

use yii\web\AssetBundle;

class JqCloudAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/jqcloud';
    public $css = [
        'jqcloud.css',
    ];
    public $js = [
        'jqcloud-1.0.4.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
