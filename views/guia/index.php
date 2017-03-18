<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\GuiaSearch $searchModel
 */

$this->title = 'Lista de Guías';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NUM_OBRA',
            'NUM_GUIA',
            [
                'attribute' => 'FECH_LLEGA',
                'label' => 'Fecha De Llegada',
                'format' => ['date', 'php:d-m-Y'],
                'value' => 'FECH_LLEGA'
            ],
            [
                'attribute' => 'FECH_CORTE',
                'label' => 'Fecha De Corte',
                'format' => ['date', 'php:d-m-Y'],
                'value' => 'FECH_CORTE'
            ],
            'DI_GRACIA',
//            'COD_ESTA',
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
                        return Html::a('<span class="fa fa-cogs"></span>', $url, ['title' => Yii::t('app', 'Generar Contrato'), 'target' => '_blank', 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
                    },

                    'archivo' => function ($url, $model) {
//                        return Html::a('<i class="fa fa-cloud-upload"></i>', ['archivo', 'id' => $model['Codigo_venta']], ['title' => Yii::t('app', 'Subir Archivo'), 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
                        return Html::a('<i class="fa fa-cloud-upload"></i>', $url, ['title' => Yii::t('app', 'Subir Archivo'), 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
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
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Refrescar Lista', ['index'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>
