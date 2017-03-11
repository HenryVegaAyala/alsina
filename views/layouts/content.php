<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <center>
        <strong>Copyright &copy; <?= date('Y') ?> Alsina Encofrados </strong>
        Todos los derechos reservados.
    </center>
</footer>

