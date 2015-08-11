<?php

use app\components\Git;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

?>
<div class="package-view">

    <h2><?= Html::a(Html::encode($model->name), ['view', 'name' => $model->name]) ?></h2>

    <div class="row">
        <div class="col-sm-10">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'description',
                    'keywords',
                    [
                        'label' => 'Links',
                        'value' => $model->getLinksHtml(false),
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-sm-2">
            <?php
            if ($model->screenshots) {
                echo Html::a(Html::img($model->screenshots[0], [
                    'class' => 'thumbnail',
                    'style' => 'max-width:100%',
                ]), ['view', 'name' => $model->name]);
            }
            ?>
        </div>
    </div>

</div>
