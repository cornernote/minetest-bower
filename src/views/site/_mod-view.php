<?php

use app\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

?>
<div class="col-md-3 site-mod-view">

    <div class="thumbnail">
        <?php
        if ($model->screenshots) {
            echo Html::a(Html::img($model->screenshots[0]), ['/mod/view', 'name' => $model->name]);
        } else {
            echo Html::a(Html::img('@web/img/no-image.png'), ['/mod/view', 'name' => $model->name]);
        }
        ?>
        <div class="caption">
            <h3><?= Html::a(Html::encode($model->name), ['/mod/view', 'name' => $model->name]) ?></h3>

            <p><?= $model->description; ?></p>

            <p><?= $model->getLinksHtml(); ?></p>
        </div>
    </div>
</div>
