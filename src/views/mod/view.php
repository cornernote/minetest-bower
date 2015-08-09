<?php

use app\components\Git;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-view">

    <h1>
        <?= Html::encode($this->title) ?>
        <?= Html::a('Update bower.json', ['update', 'name' => $model->name], ['class' => 'btn btn-primary pull-right']) ?>
    </h1>

    <?php
    if (!$model->bower) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'body' => 'This mod has no ' . Html::a('bower.json', ['/docs/bower-json-format']) . ' file.  Please consider adding one to the <a href="' . Git::getUrl($model->url) . '">repository</a>.',
        ]);
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description',
            'keywords',
            'homepage:url',
            //[
            //    'attribute' => 'url',
            //    'value' => Git::getUrl($model->url),
            //    'format' => 'url',
            //],
            [
                'attribute' => 'screenshot',
                'label' => 'Screenshots',
                'format' => 'raw',
                'value' => $model->getScreenshotsHtml(),
            ],
            //'hits',
            [
                'attribute' => 'bower',
                'format' => 'raw',
                'value' => '<pre>' . $model->bower . '</pre>',
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
