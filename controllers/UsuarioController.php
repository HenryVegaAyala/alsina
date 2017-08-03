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

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->password_hash == $model->password_repeat) {
                $Codigo = $model->id;
                $PassDes = $model->pwdDes = $model->password_hash;
                $PassEncryt = Password::hash($model->password_hash);
                $Fecha_Modi = $model->Fecha_Modificada = $this->zonaHoraria();
                $Usu_Modi = $model->Usuario_Modificado = Yii::$app->user->identity->email;
                $model->actualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi);
                Yii::$app->session->setFlash('success', 'Se cambio la contraseña exitosamente.');

                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Las contraseñas no coinciden, por favor validar.');

                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $url = Yii::$app->request->url;
            $urlArray = explode('/', $url);
            $homeUrl = Yii::$app->request->url;
            $homeUrlFormato = '/' . $urlArray[1] . '/' . $urlArray[2] . '/' . Yii::$app->user->identity->id;
            if ($homeUrl == $homeUrlFormato) {
                return $this->render('update', ['model' => $model,]);
            } else {
                return $this->render('/site/error_403');
            }
        }
    }

    /**
     * @param $id
     * @return UsuarioController|Usuario
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return false|string
     */
    public function zonaHoraria()
    {
        date_default_timezone_set('America/Lima');
        $Fecha_Hora = date('Y-m-d h:i:s', time());

        return $Fecha_Hora;
    }

}
