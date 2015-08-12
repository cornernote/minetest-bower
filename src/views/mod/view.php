<?php

use app\components\Git;
use kartik\detail\DetailView;
use yii\bootstrap\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-view">

    <div class="row">
        <div class="col-lg-8">
            <?= $model->getReadmeHtml() ?>
            <?php
            if (!$model->readme) {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-danger',
                    ],
                    'closeButton' => false,
                    'body' => 'This mod has no readme.  If you are the owner please consider adding one to the <a href="' . Git::getUrl($model->url) . '">repository</a>.',
                ]);
            }
            ?>
        </div>
        <div class="col-lg-4 small">
            <?= DetailView::widget([
                'model' => $model,
                'hideIfEmpty' => true,
                'attributes' => [
                    'name',
                    //'description',
                    'keywords',
                    [
                        'label' => 'Links',
                        'value' => $model->getLinksHtml(false),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Authors',
                        'value' => $model->getAuthorsHtml(),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'License',
                        'value' => $model->getLicenseHtml(),
                        'format' => 'raw',
                    ],
                    //'hits',
                    'created_at',
                    //[
                    //    'attribute' => 'updated_at',
                    //    'value' => $model->updated_at . '&nbsp;&nbsp;[' . Html::a('update', ['update', 'name' => $model->name]) . ']',
                    //    'format' => 'raw',
                    //],
                ],
            ]) ?>

            <p>
                <?= Html::a('Update <i class="glyphicon glyphicon-chevron-right"></i>', ['update', 'name' => $model->name], ['class' => 'btn btn-sm btn-default']); ?>
                <?= Html::a('View bower.json <i class="glyphicon glyphicon-chevron-right"></i>', ['bower', 'name' => $model->name], ['class' => 'btn btn-sm btn-default']); ?>
            </p>

            <?= $model->getScreenshotsHtml(); ?>

            <?php if (!$model->bower) { ?>
                <?= Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'closeButton' => false,
                    'body' => 'This mod has no valid bower.json file.  If you are the owner please consider adding one to the repository, then click Update.',
                ]); ?>
            <?php } ?>

        </div>
    </div>

</div>
