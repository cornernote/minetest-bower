<?php

use app\components\Git;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name . ' Screenshots';
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Screenshots';
?>
<div class="mod-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!$model->screenshots) { ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert-info',
            ],
            'closeButton' => false,
            'body' => 'This mod has no valid screenshots.',
        ]); ?>

        <p>If you are the mod owner then please add a
            <code>screenshot.png</code> file to the
            <?= Html::a('repository', Git::getUrl($model->url)) ?>, then click
            <?= Html::a('Update', ['update', 'name' => $model->name]) ?>.
        </p>

    <?php } ?>

    <p>This site loads the description about your mod from a file named <code>bower.json</code> in your repository.</p>

    <p>You will find below a sample bower.json to insert screenshots into your package.</p>

    <h2>Sample bower.json File</h2>
    <pre><?= json_encode([
            'name' => $model->name,
            'screenshots' => ['https://example.com/screenshot.png', 'https://example.com/screenshot2.png'],
        ], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES); ?></pre>

    <p>
        <?= Html::a('Update <i class="glyphicon glyphicon-chevron-right"></i>', ['update', 'name' => $model->name], ['class' => 'btn btn-sm btn-default']); ?>
        <?= Html::a('bower.json Format <i class="glyphicon glyphicon-chevron-right"></i>', ['/docs/bower-format'], ['class' => 'btn btn-sm btn-default']); ?>
    </p>

</div>
