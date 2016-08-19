<?php

use app\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

?>
<div class="mod-view">

    <h2><?= Html::a(Html::encode($model->name), ['view', 'name' => $model->name]) ?></h2>

    <div class="row small">
        <div class="col-sm-2">
            <?php
            if ($model->screenshots) {
                echo Html::a(Html::img($model->screenshots[0], ['class' => 'thumbnail']), ['view', 'name' => $model->name]);
            } else {
                echo Html::a(Html::img('@web/img/no-image.png', ['class' => 'thumbnail']), ['view', 'name' => $model->name]);
            }
            ?>
        </div>
        <div class="col-sm-10">
            <?= DetailView::widget([
                'model' => $model,
                'hideIfEmpty' => true,
                'attributes' => [
                    'description',
                    [
                        'label' => 'Keywords',
                        'value' => $model->getKeywordsHtml(),
                        'format' => 'raw',
                    ],
                    //[
                    //    'label' => 'Authors',
                    //    'value' => $model->getAuthorsHtml(),
                    //    'format' => 'raw',
                    //],
                    //[
                    //    'label' => 'License',
                    //    'value' => $model->getLicenseHtml(),
                    //    'format' => 'raw',
                    //],
                    [
                        'label' => 'Links',
                        'value' => $model->getLinksHtml(),
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
