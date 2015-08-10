<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="jumbotron">
    <div class="container">
        <?= Html::img(Yii::getAlias('@web') . '/logo.png', [
            'id' => 'logo',
            'class' => 'pull-left',
        ]) ?>
        <div>
            <h1><?= Yii::$app->name; ?></h1>

            <p>A mod repository and package manager for Minetest.</p>
        </div>

        <!--
        <p>
            <a class="btn btn-success btn-lg" href="<?= Url::to(['/audit']); ?>" role="button">Getting Started</a>
        </p>
        -->
    </div>
</div>
