<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var app\models\Guia $model
 */

$this->title = 'Registrar Guía Nueva';
$this->params['breadcrumbs'][] = ['label' => 'Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="guia-create">
    <?php Pjax::begin(); ?>
    <?= $this->render('_form', ['model' => $model, 'categorias' => $categorias,]) ?>
    <?php Pjax::end() ?>
</div>
