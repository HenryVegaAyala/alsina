<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Guia */

$this->title = $model->COD_GUIA;
$this->params['breadcrumbs'][] = ['label' => 'Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->COD_GUIA], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->COD_GUIA], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'COD_GUIA',
            'NUM_OBRA',
            'NUM_GUIA',
            'FECH_LLEGA',
            'FECH_CORTE',
            'DI_GRACIA',
            'FECH_DIGI',
            'FECH_MODI',
            'FECH_ELIM',
            'USU_DIGI',
            'USU_MODI',
            'USU_ELIM',
            'COD_ESTA',
        ],
    ]) ?>

</div>
