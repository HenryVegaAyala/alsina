<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\widgets\DatePicker;
use kartik\tabs\TabsX;
use yii\helpers\Url;

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

    <?php $form = ActiveForm::begin(['method' => 'post']); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'NUM_OBRA')->textInput(['maxlength' => 6,'readonly' => true]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'NUM_GUIA')->textInput(['maxlength' => 6,'readonly' => true]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'DI_GRACIA')->textInput(['maxlength' => 3,'readonly' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'FECH_LLEGA')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => ''],
                        'value' => date('d-M-Y'),
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'disabled' => true,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => TRUE,
                        ]
                    ]);
                    ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'FECH_CORTE')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => ''],
                        'value' => date('d-M-Y'),
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'disabled' => true,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => TRUE,
                        ]
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label class="form-control">Listas De Productos:</label></ul>
                </div>
            </div>

            <?php
            //
            //            $items = [];
            //            foreach ($categoria as $item => $value) {
            //
            ////                        $var = ['label' => $value['DESC_CORTA'], 'content' => $this->render('/guia/elementos'), 'active' => true, 'options' => ['id' => 'alsina_' . $i . ''],];
            //                $var = ['label' => $value['DESC_CORTA'], 'content' => $this->render('/guia/elementos'), 'options' => ['id' => 'alsina'],];
            ////                        echo $val;
            //                var_dump($var);
            //
            //            }
            //            $items = [$var];

            ?>

            <?php
            $items = [

                [
                    'label' => 'ALISPLY MUROS',
                    'content' => $this->render('/guia/elementos2', ['id' => 1,'codigo' => $model->COD_GUIA ]),
                    'headerOptions' => ['style' => 'font-weight:bold', 'id' => 'elemento1', 'value' => '1'],
                    'options' => ['id' => '1'],
//                    'active' => true,
                ],
                [
                    'label' => 'ALISPLY MANUAL',
                    'content' => $this->render('/guia/elementos2', ['id' => 2,'codigo' => $model->COD_GUIA ]),
                    'headerOptions' => ['style' => 'font-weight:bold', 'id' => 'elemento2', 'value' => '2'],
                    'options' => ['id' => '2'],
                ],
                [
                    'label' => 'ALISPILAR',
                    'content' => $this->render('/guia/elementos2', ['id' => 3,'codigo' => $model->COD_GUIA ]),
                    'headerOptions' => ['style' => 'font-weight:bold', 'id' => 'elemento3', 'value' => '3'],
                    'options' => ['id' => '3'],
                ],
                [
                    'label' => 'MECANOFLEX',
                    'content' => $this->render('/guia/elementos2', ['id' => 4,'codigo' => $model->COD_GUIA ]),
                    'headerOptions' => ['style' => 'font-weight:bold', 'id' => 'elemento4', 'value' => '4'],
                    'options' => ['id' => '4'],
                ],
                [
                    'label' => 'ALULOSAS',
                    'content' => $this->render('/guia/elementos2', ['id' => 5,'codigo' => $model->COD_GUIA ]),
                    'headerOptions' => ['style' => 'font-weight:bold', 'id' => 'elemento5', 'value' => '5'],
                    'options' => ['id' => '5'],
                ],
                [
                    'label' => 'ANDAMIO DE FERRALLAR',
                    'content' => $this->render('/guia/elementos2', ['id' => 6,'codigo' => $model->COD_GUIA ]),
                    'headerOptions' => ['style' => 'font-weight:bold', 'id' => 'elemento6', 'value' => '6'],
                    'options' => ['id' => '6'],
                ],
                [
                    'label' => 'VCM',
                    'content' => $this->render('/guia/elementos2', ['id' => 7,'codigo' => $model->COD_GUIA ]),
                    'headerOptions' => ['style' => 'font-weight:bold', 'id' => 'elemento7', 'value' => '7'],
                    'options' => ['id' => '7'],
                ],
            ];

            echo TabsX::widget([
                'position' => TabsX::POS_ABOVE,
                'items' => $items,
                'height' => TabsX::SIZE_MEDIUM,
                'bordered' => true,
                'encodeLabels' => false
            ]);
            ?>

        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "" : '<i class="fa fa-plus-square" aria-hidden="true"></i> Guardar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? " Cancelar" : '<i class="fa fa-window-close-o" aria-hidden="true"></i> Cancelar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['/guia/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>