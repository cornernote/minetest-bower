<?php

/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\helpers\Html;

$this->title = 'Documentation';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Nav::widget([
        'items' => [
            ['label' => 'Bower CLI', 'url' => ['/docs/bower-cli']],
            ['label' => 'bower.json Format', 'url' => ['/docs/bower-format']],
            ['label' => 'Update Webhook', 'url' => ['/docs/update-webhook']],
            ['label' => 'Semantic Versioning', 'url' => ['/docs/semver']],
            ['label' => 'Registry Requests using cURL', 'url' => ['/docs/registry-curl']],
        ],
    ]) ?>

</div>
