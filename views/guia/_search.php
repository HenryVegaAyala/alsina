<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\GuiaSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="guia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'COD_GUIA') ?>

    <?= $form->field($model, 'OBRA_COD_OBRA') ?>

    <?= $form->field($model, 'NUM_GUIA') ?>

    <?= $form->field($model, 'FECH_LLEGA') ?>

    <?= $form->field($model, 'FECH_CORTE') ?>

    <?php // echo $form->field($model, 'DI_GRACIA') ?>

    <?php // echo $form->field($model, 'FECH_DIGI') ?>

    <?php // echo $form->field($model, 'FECH_MODI') ?>

    <?php // echo $form->field($model, 'FECH_ELIM') ?>

    <?php // echo $form->field($model, 'USU_DIGI') ?>

    <?php // echo $form->field($model, 'USU_MODI') ?>

    <?php // echo $form->field($model, 'USU_ELIM') ?>

    <?php // echo $form->field($model, 'COD_ESTA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
