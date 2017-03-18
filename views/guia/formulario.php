<?php
/**
 * Created by PhpStorm.
 * User: HENRY
 * Date: 18/03/2017
 * Time: 12:15 PM
 */
$this->title = 'Reporte Guía ';
$this->params['breadcrumbs'][] = ['label' => 'Guias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-create">

    <?= $this->render('_formulario', ['model' => $model,]) ?>

</div>
