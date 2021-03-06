<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\DatePicker;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\GuiaSearch $searchModel
 */

$this->title = 'Lista de Guías';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-index">

    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'NUM_GUIA',
                'label' => 'N° de Guía',
                'value' => 'NUM_GUIA',
            ],
            [
                'attribute' => 'FECH_LLEGA',
                'value' => 'FECH_LLEGA',
                'format' => ['date', 'php:d-m-Y'],
                'options' => ['style' => 'width: 20%;'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'FECH_LLEGA',
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'id' => 'FECH_LLEGA',
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'startView' => 'days',
                    ],
                ]),
            ],
            [
                'attribute' => 'FECH_CORTE',
                'value' => 'FECH_CORTE',
                'format' => ['date', 'php:d-m-Y'],
                'options' => ['style' => 'width: 20%;'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'FECH_CORTE',
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'id' => 'FECH_CORTE',
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'startView' => 'days',
                    ],
                ]),
            ],
            'DI_GRACIA',
            [
                'attribute' => 'COD_ESTA',
                'label' => 'Monto Total',
                'value' => function ($data) {
                    $model = new \app\models\Guia();
                    $Codigo = $data->COD_GUIA;
                    $total = $model->MontoGuia($Codigo);

                    return $total;
                },
            ],
            'NUM_OBRA',
            [

                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones de Guía',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view} {update} {delete}</div>',
                'options' => ['style' => 'width:130px;'],
                'headerOptions' => ['class' => 'itemHide'],
                'contentOptions' => ['class' => 'itemHide'],
                'buttons' => [
                    'contrato' => function ($url, $model) {
                        return Html::a('<span class="fa fa-cogs"></span>', $url, [
                            'title' => Yii::t('app', 'Generar Contrato'),
                            'target' => '_blank',
                            'class' => 'btn btn-default',
                            'data' => ['pjax' => 0],
                        ]);
                    },

                    'archivo' => function ($url, $model) {
//                        return Html::a('<i class="fa fa-cloud-upload"></i>', ['archivo', 'id' => $model['Codigo_venta']], ['title' => Yii::t('app', 'Subir Archivo'), 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
                        return Html::a('<i class="fa fa-cloud-upload"></i>', $url, [
                            'title' => Yii::t('app', 'Subir Archivo'),
                            'class' => 'btn btn-default',
                            'data' => ['pjax' => 0],
                        ]);
                    },

                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
//            'type' => 'info',
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Refrescar Lista', ['index'],
                ['class' => 'btn btn-primary']),
            'showFooter' => false,
        ],
    ]);
    Pjax::end(); ?>

</div>
