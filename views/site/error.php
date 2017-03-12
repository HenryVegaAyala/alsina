<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = "Error de Página";
?>

<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/error.css"/>
<section class="content">

    <div class="cover">
        <h1>Error Interno del Servidor</h1>
        <p class="lead">¡Vaya! Algo salió mal.<br/><br/>Trata de volver a cargar esta página o no dudes en contactar con nosotros si
            el problema persiste.</p>
    </div>

</section>
