<?php

use app\widgets\TagCloud;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $keywords array */


$this->title = 'Keyword Cloud';
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-cloud">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo TagCloud::widget([
        'tags' => $keywords,
    ]);
    ?>

</div>
