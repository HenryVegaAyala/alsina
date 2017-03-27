<?php

namespace app\controllers;

use app\models\DetalObraGuia;
use app\models\FacGuiaDetal;
use app\models\MaeProdu;
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
        $guiaDetal = new FacGuiaDetal();
        $obra = new Obra();
        $obraGuia = new DetalObraGuia();
        $categoria = $model->categoriaQuery();
        $producto = new MaeProdu();

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

            /*Detalle Guia*/
            $cantidad = $producto->Cantidad();

            $codigo = $_POST["NUM_PROD"];
            $categoria = $_POST["COD_MAE_CATG"];
            $producto = $_POST["COD_MAE_PRODU"];
            $elementos = $_POST["DESC_CORTAR"];
            $puxdia = $_POST["PREC_X_DIA"];
            $pesoreal = $_POST["PESO_REAL"];
            $pesovol = $_POST["PESO_VOL"];
            $ud = $_POST["UD"];
            $pesort = $_POST["PESO_REAL_TOTAL"];
            $cantidaddias = $_POST["CANT_DIAS"];
            $costototal = $_POST["COST_TOTAL"];
            $pesovt = $_POST["PESO_V_TOTAL"];

            for ($i = 0; $i < $cantidad; $i++) {
                if ($codigo[$i] <> '') {
                    $command = Yii::$app->db->createCommand(
                        "INSERT INTO fac_guia_detal (COD_GUIA_DETAL, FAC_COD_GUIA, COD_CATG, COD_MAE_PRODU, NUM_PROD, DESC_CORTAR, PREC_X_DIA, PESO_REAL, PESO_VOL, UD, PESO_REAL_TOTAL, CANT_DIAS, COST_TOTAL, PESO_V_TOTAL, FECH_DIGI, USU_DIGI, COD_ESTA)
                         VALUES (:COD_GUIA_DETAL, :FAC_COD_GUIA, :COD_CATG, :COD_MAE_PRODU, :NUM_PROD, :DESC_CORTAR, :PREC_X_DIA, :PESO_REAL, :PESO_VOL, :UD, :PESO_REAL_TOTAL, :CANT_DIAS, :COST_TOTAL, :PESO_V_TOTAL, :FECH_DIGI, :USU_DIGI, :COD_ESTA)");
                    $command->bindValue(':COD_GUIA_DETAL', $guiaDetal->getCodigoGuiaDetal());
                    $command->bindValue(':FAC_COD_GUIA', $model->COD_GUIA);
                    $command->bindValue(':COD_CATG', $categoria[$i]);
                    $command->bindValue(':COD_MAE_PRODU', $producto[$i]);
                    $command->bindValue(':NUM_PROD', $codigo[$i]);
                    $command->bindValue(':DESC_CORTAR', $elementos[$i]);
                    $command->bindValue(':PREC_X_DIA', $puxdia[$i]);
                    $command->bindValue(':PESO_REAL', $pesoreal[$i]);
                    $command->bindValue(':PESO_VOL', $pesovol[$i]);
                    $command->bindValue(':UD', $ud[$i]);
                    $command->bindValue(':PESO_REAL_TOTAL', $pesort[$i]);
                    $command->bindValue(':CANT_DIAS', $cantidaddias[$i]);
                    $command->bindValue(':COST_TOTAL', $costototal[$i]);
                    $command->bindValue(':PESO_V_TOTAL', $pesovt[$i]);
                    $command->bindValue(':FECH_DIGI', $this->ZonaHoraria());
                    $command->bindValue(':USU_DIGI', Yii::$app->user->identity->email);
                    $command->bindValue(':COD_ESTA', "1");
                    $command->execute();
                }
            }

            return $this->redirect(['view', 'id' => $model->COD_GUIA]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categoria' => $categoria,
            ]);
        }
    }

    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->save();
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
        return $this->render('elementos', ['id' => '']);
    }

    public function actionElementos2()
    {
        return $this->render('elementos2', ['id' => '']);
    }
}
