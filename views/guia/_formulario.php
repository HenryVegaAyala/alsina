<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
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
                    <?= $form->field($model, 'NUM_GUIA')->dropDownList($model->ListGuia(), ['disabled' => 'true', 'prompt' => 'Seleccionar una Guía', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-9">
                    <?php
                    $data = [
                        "red" => "red",
                        "green" => "green",
                        "blue" => "blue",
                        "orange" => "orange",
                        "white" => "white",
                        "black" => "black",
                        "purple" => "purple",
                        "cyan" => "cyan",
                        "teal" => "teal"
                    ];

                    $guia = new \app\models\Guia();
                    $lista = $guia->ListaGuia(2);

                    echo $form->field($model, 'FECH_CORTE')->widget(Select2::classname(), [
                        'data' => $lista,
                        'options' => ['placeholder' => 'Seleccionar Guia', 'multiple' => true, 'class' => 'form-control loginmodal-container-combo'],
                        'pluginOptions' => [
                            'tags' => true,
                            'tokenSeparators' => [',', ' '],
                            'maximumInputLength' => 10
                        ],
                    ])->label('Número Guía');
                    ?>

                </div>


            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Generar Reporte" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['/guia/formulario'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>