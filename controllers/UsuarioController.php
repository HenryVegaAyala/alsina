<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Alsina;
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


            if ($model->password_hash == $model->password_repeat) {
                $Codigo = $model->id;
                $PassDes = $model->pwdDes = $model->password_hash;
                $PassEncryt = Password::hash($model->password_hash);
                $Fecha_Modi = $model->Fecha_Modificada = $this->ZonaHoraria();
                $Usu_Modi = $model->Usuario_Modificado = Yii::$app->user->identity->email;
                $model->ActualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi);
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
            $homeUrlFormato = '/'.$urlArray[1].'/'.$urlArray[2].'/'.Yii::$app->user->identity->id;
            if ($homeUrl == $homeUrlFormato) {
                return $this->render('update', ['model' => $model,]);
            } else {
                return $this->render('/site/error_403');
            }
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
