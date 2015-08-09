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
            ['label' => 'Installation', 'url' => ['/docs/install']],
            ['label' => 'bower.json Format', 'url' => ['/docs/bower-format']],
        ],
    ]) ?>

</div>
