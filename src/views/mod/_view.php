<?php

use app\components\Git;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

?>
<div class="package-view">

    <h2><?= Html::a(Html::encode($model->name), ['view', 'name' => $model->name]) ?></h2>


    <?php //echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    <?php
    //echo Html::a('Delete', ['delete', 'id' => $model->id], [
    //    'class' => 'btn btn-danger',
    //    'data' => [
    //        'confirm' => 'Are you sure you want to delete this item?',
    //        'method' => 'post',
    //    ],
    //]);
    ?>

    <div class="row">
        <div class="col-sm-10">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'name',
                    'description',
                    'keywords',
                    'homepage:url',
                    //[
                    //    'attribute' => 'url',
                    //    'value' => Git::getUrl($model->url),
                    //    'format' => 'url',
                    //],
                    //'hits',
                    //'bower:ntext',
                    //'created_at',
                    //'updated_at',
                ],
            ]) ?>
        </div>
        <div class="col-sm-2">
            <?= Html::a(Html::img($model->screenshot, [
                'class' => 'thumbnail',
                'style' => 'max-width:100%',
            ]), $model->screenshot) ?>
        </div>
    </div>

</div>
