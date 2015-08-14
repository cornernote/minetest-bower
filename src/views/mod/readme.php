<?php

use app\components\Git;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name . ' README.md';
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'README.md';
?>
<div class="mod-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!$model->readme) { ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert-info',
            ],
            'closeButton' => false,
            'body' => 'This mod has no valid README.md file.',
        ]); ?>

        <p>If you are the mod owner then please add a
            <code>README.md</code> file to the
            <?= Html::a('repository', Git::getUrl($model->url)) ?>
            with the following contents, then click
            <?= Html::a('Update', ['update', 'name' => $model->name]) ?>.
        </p>

    <?php } ?>

    <p>This site loads the description about your mod from a file named <code>README.md</code> or
        <code>README.txt</code> in your repository.</p>

    <p>You will find below a sample REAMDE.md file that is used if none is present.</p>

    <h2>Sample Readme File</h2>
    <pre><?= $model->getReadmeSample(); ?></pre>

    <p>
        <?= Html::a('Update <i class="glyphicon glyphicon-chevron-right"></i>', ['update', 'name' => $model->name], ['class' => 'btn btn-sm btn-default']); ?>
        <?php //echo Html::a('README.md Format <i class="glyphicon glyphicon-chevron-right"></i>', ['/docs/readme-format'], ['class' => 'btn btn-sm btn-default']); ?>
    </p>

</div>
