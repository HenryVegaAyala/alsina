<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Guia $model
 */

$this->title = 'Registrar Nueva Guía ';
$this->params['breadcrumbs'][] = ['label' => 'Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-create">

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
