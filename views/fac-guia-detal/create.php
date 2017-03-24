<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FacGuiaDetal */

$this->title = 'Create Fac Guia Detal';
$this->params['breadcrumbs'][] = ['label' => 'Fac Guia Detals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fac-guia-detal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelo' => '',
        'id' => '',
    ]) ?>

</div>
