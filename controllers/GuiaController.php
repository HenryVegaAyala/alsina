<?php

namespace app\controllers;

use app\models\DetalObraGuia;
use app\models\Obra;
use app\models\ObraGuia;
use Yii;
use app\models\Guia;
use app\models\GuiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class GuiaController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new GuiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Guia();
        $obra = new Obra();
        $obraGuia = new DetalObraGuia();
        $categoria = $model->categoriaQuery();

        if ($model->load(Yii::$app->request->post())) {

            /*Fecha Formateada*/
            $FechaLlegada = substr($model->FECH_LLEGA, 6, 4) . '-' . substr($model->FECH_LLEGA, 3, 2) . '-' . substr($model->FECH_LLEGA, 0, 2);
            $FechaCorte = substr($model->FECH_CORTE, 6, 4) . '-' . substr($model->FECH_CORTE, 3, 2) . '-' . substr($model->FECH_CORTE, 0, 2);

            /*Guia*/
            $model->COD_GUIA = $model->getCodigoGuia();
            $model->FECH_LLEGA = $FechaLlegada;
            $model->FECH_CORTE = $FechaCorte;
            $model->FECH_DIGI = $this->ZonaHoraria();
            $model->USU_DIGI = Yii::$app->user->identity->email;
            $model->COD_ESTA = '1';

            /*Obra*/
            $obra->COD_OBRA = $obra->getCodigoObra();
            $obra->NUM_OBRA = $model->NUM_OBRA;
            $obra->FEC_DIGI = $this->ZonaHoraria();
            $obra->USU_DIGI = Yii::$app->user->identity->email;
            $obra->COD_ESTA = '1';

            /*Detalle Obra Guia*/
            $obraGuia->COD_OBRA_GUIA = $obraGuia->getCodigoObraGuia();
            $obraGuia->OBRA_COD_OBRA = $obra->COD_OBRA;
            $obraGuia->GUIA_COD_GUIA = $model->COD_GUIA;
            $obraGuia->FECH_DIGI = $this->ZonaHoraria();
            $obraGuia->USU_DIGI = Yii::$app->user->identity->email;
            $obraGuia->COD_ESTADO = '1';

            $model->save();
            $obra->save();
            $obraGuia->save();
            return $this->redirect(['view', 'id' => $model->COD_GUIA]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categoria' => $categoria,
            ]);
        }
    }

    public function actionFormulario()
    {
        $model = new Guia();
        if ($model->load(Yii::$app->request->post())) {

            return $this->redirect(['reporte']);
        } else {
            return $this->render('formulario', ['model' => $model,]);
        }

    }

    public function actionElementos()
    {
        return $this->render('elementos');
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->COD_GUIA]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Guia::findOne($id)) !== null) {
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
