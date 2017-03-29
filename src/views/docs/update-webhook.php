<?php
/* @var $this yii\web\View */
use app\components\Git;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Update Webhook';
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-github-webhook">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Adding a webhook to your repository will update minetest-bower with the latest information each time you push a change.</p>

    <h2>GitHub</h2>

    <p>Create a new webhook and enter
        <code><?= Url::to(['update', 'name' => $model->name], true); ?></code> into the
        <em>Payload URL</em>, then click <em>Add webhook</em>.</p>
    <?= Html::img('https://cloud.githubusercontent.com/assets/51875/9213435/7cf27a68-40d1-11e5-888a-c4692ad9f4b9.png'); ?>

    <h2>BitBucket</h2>

    <p>Create a new webhook and enter
        <code><?= Url::to(['update', 'name' => $model->name], true); ?></code> into the URL. </p>
    <?= Html::img('https://cloud.githubusercontent.com/assets/51875/9217084/5f2da65c-4102-11e5-81b5-61b313a39aa7.png'); ?>

</div>
