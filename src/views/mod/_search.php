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
    echo $form->field($model, 'search', [
        'inputOptions' => [
            'name' => 'search',
        ],
        'addon' => [
            'append' => [
                'content' => Html::submitButton('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-primary']),
                'asButton' => true
            ]
        ]
    ])
        ->label(false);
        //->hint(Html::a('popular keywords', ['cloud']));
    ?>

    <?php ActiveForm::end(); ?>

</div>
