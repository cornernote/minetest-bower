<?php

use app\components\Git;
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
        <?= Html::a('Update', ['update', 'name' => $model->name], ['class' => 'btn btn-primary pull-right']) ?>
    </h1>

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
