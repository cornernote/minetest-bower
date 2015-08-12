<?php

use app\components\Git;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
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
            <?= Html::a('repository', Git::getUrl($model->url)) ?>
            with the following contents, then click
            <?= Html::a('Update', ['update', 'name' => $model->name]) ?>.
        </p>

    <?php } ?>

    <?= $model->getBowerJson(); ?>

    <p>
        <?= Html::a('Update <i class="glyphicon glyphicon-chevron-right"></i>', ['update', 'name' => $model->name], ['class' => 'btn btn-sm btn-default']); ?>
        <?= Html::a('bower.json Format <i class="glyphicon glyphicon-chevron-right"></i>', ['/docs/bower-format'], ['class' => 'btn btn-sm btn-default']); ?>
    </p>

    <?php if (strpos($model->url, 'github.com') || strpos($model->url, 'bitbucket.org')) { ?>
        <h2>Auto Update using Webhooks</h2>
        <p>Adding a webhook to your repository will update minetest-bower with the latest information each time you push a change.</p>

        <?php if (strpos($model->url, 'github.com')) { ?>
            <p>Create a <?= Html::a('new webhook', Git::getUrl($model->url) . '/settings/hooks/new') ?> and enter
                <code><?= Url::to(['bower', 'name' => $model->name], true); ?></code> into the
                <em>Payload URL</em>, then click <em>Add webhook</em>.</p>
            <?= Html::img('https://cloud.githubusercontent.com/assets/51875/9213435/7cf27a68-40d1-11e5-888a-c4692ad9f4b9.png'); ?>
        <?php } elseif (strpos($model->url, 'bitbucket.org')) { ?>
            <p>Create a <?= Html::a('new webhook', Git::getUrl($model->url) . '/admin/addon/admin/bitbucket-webhooks/bb-webhooks-repo-admin') ?> and enter
                <code><?= Url::to(['bower', 'name' => $model->name], true); ?></code> into the URL. </p>
            <?= Html::img('https://cloud.githubusercontent.com/assets/51875/9217084/5f2da65c-4102-11e5-81b5-61b313a39aa7.png'); ?>
        <?php } ?>
    <?php } ?>

</div>
