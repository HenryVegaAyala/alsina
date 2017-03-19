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

    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'NUM_OBRA')->textInput() ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'NUM_GUIA')->textInput(['maxlength' => 6]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'DI_GRACIA')->textInput(['maxlength' => 3]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'FECH_LLEGA')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => ''],
                        'value' => date('d-M-Y'),
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
//                        'readonly' => true,
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
//                        'readonly' => true,
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

            $items = [

                [
                    'label' => 'ALISPLY MUROS',
                    'content' => $this->render('/guia/elementos'),
                    'active' => true,
                    'options' => ['id' => 'alsina_1'],
                ],
                [
                    'label' => 'ALISPLY MANUAL',
                    'content' => 'Anim pariatur cliche...',
                    'headerOptions' => ['style' => 'font-weight:bold'],
                    'options' => ['id' => 'myveryownID'],
                ],
                [
                    'label' => 'ALISPILAR',
                    'content' => 'Anim pariatur cliche...',
                    'headerOptions' => ['style' => 'font-weight:bold'],
                    'options' => ['id' => 'myveryownID'],
                ],
                [
                    'label' => 'MECANOFLEX',
                    'content' => 'Anim pariatur cliche...',
                    'headerOptions' => ['style' => 'font-weight:bold'],
                    'options' => ['id' => 'myveryownID'],
                ],
                [
                    'label' => 'ALULOSAS',
                    'content' => 'Anim pariatur cliche...',
                    'headerOptions' => ['style' => 'font-weight:bold'],
                    'options' => ['id' => 'myveryownID'],
                ],
                [
                    'label' => 'ANDAMIO DE FERRALLAR',
                    'content' => 'Anim pariatur cliche...',
                    'headerOptions' => ['style' => 'font-weight:bold'],
                    'options' => ['id' => 'myveryownID'],
                ],
                [
                    'label' => 'VCM',
                    'content' => 'Anim pariatur cliche...',
                    'headerOptions' => ['style' => 'font-weight:bold'],
                    'options' => ['id' => 'myveryownID'],
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
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>