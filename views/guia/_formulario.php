<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\widgets\DatePicker;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Guia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(['options' => ['target' => '_blank']]); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'NUM_OBRA')->widget(AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',

                        ],
                        'clientOptions' => [
                            'source' => $model->ListObra(),
                        ],
                    ])
                    ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'NUM_GUIA')->dropDownList($model->ListGuia(), ['prompt' => 'Seleccionar una Guía', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <?php
                $guia = new \app\models\Guia();
                $lista = $guia->ListaGuia(2);
                echo "<option value=\"\">Seleccionar una Guía</option>";
                foreach ($lista as $data):
                    echo "<option value=\"{$data->NUM_GUIA}\">{$data->NUM_GUIA}</option>";
                endforeach;
                ?>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>