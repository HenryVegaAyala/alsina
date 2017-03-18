<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Guia $model
 */

$this->title = 'Update Guia: ' . ' ' . $model->COD_GUIA;
$this->params['breadcrumbs'][] = ['label' => 'Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->COD_GUIA, 'url' => ['view', 'id' => $model->COD_GUIA]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
