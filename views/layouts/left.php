<aside class="main-sidebar">

    <section class="sidebar">

        <center>
            <h4>Menú del Sistema</h4>
        </center>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [

                    ['label' => 'Registrar Guía', 'icon' => 'fa fa-id-card-o', 'url' => ['/guia/create'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Listar Guía', 'icon' => 'fa fa-list-ul', 'url' => ['/guia/index'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Reportes', 'icon' => 'fa fa-file-pdf-o', 'url' => ['/guia/formulario'], 'visible' => !Yii::$app->user->isGuest],
                ],
            ]
        ) ?>
    </section>

</aside>
