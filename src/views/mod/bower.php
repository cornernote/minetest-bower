<?php

use app\components\Git;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name . ' bower.json';
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'bower.json';
?>
<div class="mod-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!$model->bower) { ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert-info',
            ],
            'closeButton' => false,
            'body' => 'This mod has no valid bower.json file.',
        ]); ?>

        <p>If you are the mod owner then please add a
            <code>bower.json</code> file to the
            <a href="' . Git::getUrl($model->url) . '">repository</a> with the following contents, then click
            <?= Html::a('Update', ['update', 'name' => $model->name]) ?>.
        </p>

    <?php } ?>

    <?= $model->getBowerJson(); ?>

    <p><?= Html::a('bower.json Format  &raquo;', ['/docs/bower-format'], ['class' => 'btn btn-sm btn-default']); ?></p>

</div>
