<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelo app\models\FacGuiaDetal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fac-guia-detal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $id?>


    <?= $form->field($modelo, 'NUM_PROD')->textInput() ?>

    <?= $form->field($modelo, 'DESC_CORTAR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'DESC_LARGA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'PREC_X_DIA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'PESO_REAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'PESO_VOL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'UD')->textInput() ?>

    <?= $form->field($modelo, 'PESO_REAL_TOTAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'CANT_DIAS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'COST_TOTAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'PESO_V_TOTAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'FECH_DIGI')->textInput() ?>

    <?= $form->field($modelo, 'FECH_MODI')->textInput() ?>

    <?= $form->field($modelo, 'FECH_ELIM')->textInput() ?>

    <?= $form->field($modelo, 'USU_DIGI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'USU_MODI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'USU_ELI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelo, 'COD_ESTA')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($modelo->isNewRecord ? 'Create' : 'Update', ['class' => $modelo->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
