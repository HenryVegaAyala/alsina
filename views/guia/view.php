<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Guia */

$this->title = "N° de Guía: " . $model->NUM_GUIA;
$this->params['breadcrumbs'][] = ['label' => 'Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$attributes = [

    [
        'group' => true,
        'label' => 'Información Detallada',
        'rowOptions' => ['class' => 'info']
    ],
    [
        'columns' => [
            [
                'attribute' => 'NUM_OBRA',
                'label' => 'N° de Obra',
                'format' => 'raw',
                'value' => "$model->NUM_OBRA",
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'DI_GRACIA',
                'label' => 'Días de Gracia',
                'format' => 'raw',
                'value' => "$model->DI_GRACIA",
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],
    [
        'columns' => [
            [
                'attribute' => 'FECH_LLEGA',
                'label' => 'Fecha de Llegada',
                'format' => 'raw',
                'value' => Yii::$app->formatter->asDate($model->FECH_LLEGA, "php:d-m-Y"),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'FECH_CORTE',
                'label' => 'Fecha de Corte',
                'format' => 'raw',
                'value' => Yii::$app->formatter->asDate($model->FECH_CORTE, "php:d-m-Y"),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],

    [
        'group' => true,
        'label' => 'Costo por Elementos (P.U x dia * Ud. * Cantidad de Días)',
        'rowOptions' => ['class' => 'info']
    ],
    [
        'columns' => [
            [
                'attribute' => 'COD_ESTA',
                'label' => 'ALISPLY MUROS',
                'format' => 'raw',
                'value' => $model->MontoGuiaElemento(1,$model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'COD_ESTA',
                'label' => 'ALISPLY MANUAL',
                'format' => 'raw',
                'value' => $model->MontoGuiaElemento(2,$model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],

    [
        'columns' => [
            [
                'attribute' => 'COD_ESTA',
                'label' => 'ALISPILAR',
                'format' => 'raw',
                'value' => $model->MontoGuiaElemento(3,$model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'COD_ESTA',
                'label' => 'MECANOFLEX',
                'format' => 'raw',
                'value' => $model->MontoGuiaElemento(4,$model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],

    [
        'columns' => [
            [
                'attribute' => 'COD_ESTA',
                'label' => 'ALULOSAS',
                'format' => 'raw',
                'value' => $model->MontoGuiaElemento(5,$model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'COD_ESTA',
                'label' => 'ANDAMIO DE FERRALLAR',
                'format' => 'raw',
                'value' => $model->MontoGuiaElemento(6,$model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],

    [
        'columns' => [
            [
                'attribute' => 'COD_ESTA',
                'label' => 'VCM',
                'format' => 'raw',
                'value' => $model->MontoGuiaElemento(7,$model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'COD_ESTA',
                'label' => '',
                'format' => 'raw',
                'value' => '',
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],

    [
        'group' => true,
        'label' => 'Costo Total de La Guía',
        'rowOptions' => ['class' => 'info']
    ],
    [
        'columns' => [
            [
                'attribute' => 'COD_ESTA',
                'label' => 'COSTO TOTAL',
                'format' => 'raw',
                'value' => $model->MontoGuiaTotal($model->COD_GUIA),
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'COD_ESTA',
                'label' => '',
                'format' => 'raw',
                'value' => '',
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],
];
?>

<div class="panel panel-default" xmlns="http://www.w3.org/1999/html">

    <div class="panel-heading">
        <h3 class="panel-title">
            <div class="pull-right">
                <?= Html::a('<span class="fa fa-pencil fa-lg"></span>', ['update', 'id' => $model->COD_GUIA], ['title' => 'Actualizar', 'aria-label' => 'Actualizar', 'data-pjax' => '0']) ?>
            </div>
        </h3>
        <h3 class="panel-title"><strong><?= 'N° de Guía: ' . strtoupper($model->NUM_GUIA) ?></strong>
        </h3>
    </div>

    <?= DetailView::widget([
        'model' => $model,

        'attributes' => $attributes,
        'mode' => 'view',
        'bordered' => 'bordered',
        'striped' => 'striped',
        'condensed' => 'condensed',
        'responsive' => 'responsive',
        'hover' => 'hover',
        'hAlign' => 'hAlign',
        'vAlign' => 'vAlign',
        'fadeDelay' => 'fadeDelay',
    ]) ?>
    <div class="panel-footer container-fluid foo">
        <p>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
</div>
</div>
