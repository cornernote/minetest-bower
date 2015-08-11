<?php

namespace app\widgets;

use app\assets\JqCloudAsset;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class TagCloud
 * @package app\widgets
 */
class TagCloud extends Widget
{
    /**
     * @var array
     */
    public $tags = [];

    /**
     * @var array
     */
    public $options = [
        'style' => [
            'height' => '500px',
        ],
    ];

    /**
     *
     */
    public function run()
    {
        $view = Yii::$app->view;
        JqCloudAsset::register($view);

        $view->registerJs('$("#' . $this->id . '").jQCloud(' . Json::encode(array_values($this->tags)) . ');');
        echo Html::tag('div', '', ArrayHelper::merge($this->options, [
            'id' => $this->id,
        ]));
    }
}