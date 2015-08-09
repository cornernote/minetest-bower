<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\search\PackageSearch */
/* @var $form kartik\form\ActiveForm */
?>

<div class="package-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php
    echo $form->field($model, 'name', [
        'addon' => [
            'append' => [
                'content' => Html::submitButton('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-primary']),
                'asButton' => true
            ]
        ]
    ])->label(false);
    ?>

    <?php ActiveForm::end(); ?>

</div>
