<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var app\models\Guia $model
 */

$this->title = 'Registrar Nueva Guía ';
$this->params['breadcrumbs'][] = ['label' => 'Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="guia-create">
    <?php Pjax::begin(); ?>
    <?= $this->render('_form', ['model' => $model,]) ?>
    <?php Pjax::end() ?>
</div>
