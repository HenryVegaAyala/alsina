<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dektrium\user\helpers\Password;

class UsuarioController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $Codigo = $model->id;
            $PassDes = $model->pwdDes = $model->password_hash;
            $PassEncryt = Password::hash($model->password_hash);
            $Fecha_Modi = $model->Fecha_Modificada = $this->ZonaHoraria();
            $Usu_Modi = $model->Usuario_Modificado = Yii::$app->user->identity->email;
            $Cod_Rol = $model->auth_key;

            $model->ActualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi, $Cod_Rol);

            return $this->redirect(['/']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function ZonaHoraria()
    {
        date_default_timezone_set('America/Lima');
        $Fecha_Hora = date('Y-m-d h:i:s', time());
        return $Fecha_Hora;
    }

}
