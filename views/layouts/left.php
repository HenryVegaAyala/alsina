<aside class="main-sidebar">

    <section class="sidebar">

        <center>
            <h4>Menú del Sistema</h4>
        </center>

        <?php yii\widgets\Pjax::begin() ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [

                    ['label' => 'Registrar Guía', 'icon' => 'fa fa-id-card-o', 'url' => ['/gii'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Listar Guía', 'icon' => 'fa fa-list-ul', 'url' => ['/gii'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Reportes', 'icon' => 'fa fa-file-pdf-o', 'url' => ['/gii'], 'visible' => !Yii::$app->user->isGuest],

//                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Same tools',
//                        'icon' => 'fa fa-share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'fa fa-circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'fa fa-circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                ],
            ]
        ) ?>
        <?php yii\widgets\Pjax::end() ?>
    </section>

</aside>
