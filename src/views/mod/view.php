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
            if ($model->readme_format == 'text') {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-danger',
                    ],
                    'closeButton' => false,
                    'body' => 'This readme is in text format.  If you are the owner please consider converting it to markdown.',
                ]);
            }
            ?>
        </div>
        <div class="col-lg-4 small">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'description',
                    'keywords',
                    [
                        'label' => 'Links',
                        'value' => $model->getLinksHtml(),
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
                    [
                        'attribute' => 'updated_at',
                        'value' => $model->updated_at . '&nbsp;&nbsp;[' . Html::a('update', ['update', 'name' => $model->name]) . ']',
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
            <?= $model->getScreenshotsHtml(); ?>
        </div>
    </div>

    <?php if (!$model->bower) { ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'closeButton' => false,
            'body' => 'This mod has no valid ' . Html::a('bower.json', ['/docs/bower-json-format']) . ' file.  If you are the owner please consider adding one to the <a href="' . Git::getUrl($model->url) . '">repository</a>.',
        ]); ?>

        <p>If you are the mod owner then please add a
            <code>bower.json</code> file to your repository with the following contents, then click
            <?= Html::a('Update', ['update', 'name' => $model->name]) ?>.
        </p>

        <?= $model->getBowerJson(); ?>

        <p><?= Html::a('bower.json Format  &raquo;', ['/docs/bower-format'], ['class' => 'btn btn-sm btn-default']); ?></p>
    <?php } ?>

</div>
