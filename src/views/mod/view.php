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
                'class' => 'alert-info',
            ],
            'closeButton' => false,
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
            [
                'label' => 'Repository',
                'value' => $model->getRepositoryHtml(),
                'format' => 'raw',
            ],
            //[
            //    'attribute' => 'url',
            //    'value' => Git::getUrl($model->url),
            //    'format' => 'url',
            //],
            [
                'label' => 'Screenshots',
                'value' => $model->getScreenshotsHtml(),
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
            //[
            //    'attribute' => 'bower',
            //    'format' => 'raw',
            //    'value' => '<pre>' . $model->bower . '</pre>',
            //],
            'hits',
            'created_at',
            //'updated_at',
        ],
    ]) ?>

    <?php
    if ($model->readme) {
        echo $model->getReadmeHtml();
    }
    ?>

    <?php if (!$model->bower) { ?>
        <p>If you are the mod owner then please add a
            <code>bower.json</code> file to your repository with the following contents, then click
            <?= Html::a('Update bower.json', ['update', 'name' => $model->name]) ?>.
        </p>

        <pre>{
  "name": "<?= $model->name; ?>",
  "description": "Description of your mod.",
  "keywords": [
    "example",
    "rainbow"
  ],
  "homepage": "<?= Git::getUrl($model->url) ?>",
  "screenshots": [
    "https://example.com/screenshot1.png"
  ],
  "authors": [
    "Your Name"
  ],
  "license": "WTFPL"
}</pre>

        <p><?= Html::a('bower.json Format  &raquo;', ['/docs/bower-format'], ['class' => 'btn btn-sm btn-default']); ?></p>
    <?php } ?>

</div>
