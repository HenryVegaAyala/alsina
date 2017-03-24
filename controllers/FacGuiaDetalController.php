<?php

namespace app\controllers;

use Yii;
use app\models\FacGuiaDetal;
use app\models\FacGuiaDetalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class FacGuiaDetalController extends Controller
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

    public function actionCreate()
    {
        $modelo = new FacGuiaDetal();

        if ($modelo->load(Yii::$app->request->post()) && $modelo->save()) {

            
            return $this->redirect(['view', 'id' => $modelo->COD_GUIA_DETAL]);
        } else {
            return $this->render('create', [
                'modelo' => $modelo,
                'id' => '',
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = FacGuiaDetal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
