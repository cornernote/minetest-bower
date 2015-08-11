<?php

use app\widgets\TagCloud;

/* @var $this yii\web\View */
/* @var $keywords array */


$this->title = 'Tag Cloud';
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-cloud">

    <?php
    echo TagCloud::widget([
        'tags' => $keywords,
    ]);
    ?>

</div>
