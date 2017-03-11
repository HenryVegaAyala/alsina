<?php
use yii\helpers\Html;
use app\models\Usuario;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.png" class="user-image" alt="Foto Usuario"/>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.png" class="img-circle"
                                 alt="Foto Usuario"/>
                            <p style="color: white">
                                <?php $model = new Usuario(); ?>
                                <?= Yii::$app->user->identity->username ?>
                                <small>Miembro
                                    desde <?= date('d-m-Y', strtotime(Yii::$app->user->identity->Fecha_Creado)) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a('Cambiar Contraseña', ['/usuario/update', 'id' => Yii::$app->user->identity->id], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?>
                            </div>
                            <div class="pull-right">
                                <?php echo Html::a('Cerrar Sesión', ['/user/security/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']); ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
