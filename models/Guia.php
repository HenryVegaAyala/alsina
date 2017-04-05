<?php

namespace app\models;

use app\controllers\GuiaController;
use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fac_guia".
 *
 * @property integer $COD_GUIA
 * @property string $NUM_OBRA
 * @property string $NUM_GUIA
 * @property string $FECH_LLEGA
 * @property string $FECH_CORTE
 * @property string $DI_GRACIA
 * @property string $FECH_DIGI
 * @property string $FECH_MODI
 * @property string $FECH_ELIM
 * @property string $USU_DIGI
 * @property string $USU_MODI
 * @property string $USU_ELIM
 * @property string $COD_ESTA
 * @property string $NUMERO_GUIA
 *
 * @property DetalObraGuia[] $detalObraGuias
 * @property FacGuiaDetal[] $facGuiaDetals
 */
class Guia extends \yii\db\ActiveRecord
{
    public $NUMERO_GUIA;

    public static function tableName()
    {
        return 'fac_guia';
    }

    public function rules()
    {
        return [
            [['FECH_LLEGA', 'FECH_CORTE'], 'required'],
            [['FECH_LLEGA', 'FECH_CORTE', 'FECH_DIGI', 'FECH_MODI', 'FECH_ELIM'], 'safe'],
            [['NUM_OBRA', 'NUM_GUIA'], 'string', 'max' => 12],
            [['USU_DIGI', 'USU_MODI', 'USU_ELIM'], 'string', 'max' => 45],
            [['COD_ESTA','NUMERO_GUIA'], 'string', 'max' => 1],

            [['NUM_OBRA'], 'required', 'message' => 'N° de Obra es necesario.'],
            [['NUM_GUIA'], 'required', 'message' => 'N° de Guía es necesario.'],
            [['NUMERO_GUIA'], 'required', 'message' => 'N° de Guía es necesario.'],
            [['DI_GRACIA'], 'required', 'message' => 'N° de Días es necesario.'],

//            [['NUM_GUIA'], 'integer', 'message' => 'Debe de ser númerico.'],
            [['NUM_GUIA'], 'match', 'pattern' => "/^.{1,12}$/", 'message' => 'Debe de minimo 1 digito.'],
            [['NUM_GUIA'], 'string', 'max' => 12],

            [['DI_GRACIA'], 'number', 'message' => 'Debe de ser númerico.'],
            [['DI_GRACIA'], 'string', 'max' => 3],
            [['DI_GRACIA'], 'match', 'pattern' => "/^.{1,3}$/", 'message' => 'Mínimo 1 digito.'],

//            [['FECH_CORTE'], 'compare', 'skipOnEmpty' => true, 'compareAttribute' => 'FECH_LLEGA', 'operator' => '>', 'message' => 'Debe ser mayor a Fecha de Llegada.'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'COD_GUIA' => 'Código de Guía',
            'NUM_OBRA' => 'Número  Obra',
            'NUM_GUIA' => 'Número  Guía',
            'NUMERO_GUIA' => 'Número  Guía',
            'FECH_LLEGA' => 'Fecha De Llegada',
            'FECH_CORTE' => 'Fecha De Corte',
            'DI_GRACIA' => 'Días De Gracia',
            'FECH_DIGI' => 'Fech  Digi',
            'FECH_MODI' => 'Fech  Modi',
            'FECH_ELIM' => 'Fech  Elim',
            'USU_DIGI' => 'Usu  Digi',
            'USU_MODI' => 'Usu  Modi',
            'USU_ELIM' => 'Usu  Elim',
            'COD_ESTA' => 'Cod  Esta',
        ];
    }

    public function getDetalObraGuias()
    {
        return $this->hasMany(DetalObraGuia::className(), ['GUIA_COD_GUIA' => 'COD_GUIA']);
    }

    public function getFacGuiaDetals()
    {
        return $this->hasMany(FacGuiaDetal::className(), ['FAC_COD_GUIA' => 'COD_GUIA']);
    }

    public function getCodigoGuia()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(COD_GUIA), 0) + 1');
        $query->select($expresion)->from('fac_guia');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function categoriaQuery()
    {
        $query = new Query();
        $select = new Expression('COD_MAE_CATG,DESC_CORTA');
        $query->select($select)->from('mae_categ')->where(['COD_ESTA' => 1])->orderBy(['DESC_CORTA' => SORT_ASC]);
        $comando = $query->createCommand();
        $resultado = $comando->queryAll();
        return $resultado;
    }

    public function MontoGuia($Codigo)
    {
        $query = new Query();
        $expresion = new Expression('sum(COST_TOTAL) AS TOTAL');
        $query->select($expresion)->from('fac_guia_detal')->where(["FAC_COD_GUIA" => $Codigo]);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function MontoGuiaElemento($Codigo, $Guia)
    {
        $query = new Query();
        $expresion = new Expression('sum(COST_TOTAL) AS TOTAL');
        $query->select($expresion)->from('fac_guia_detal')->where("COD_CATG = '" . $Codigo . "' and " . "FAC_COD_GUIA = '" . $Guia . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function GuiaValidador($numero)
    {
        $query = new Query();
        $select = new Expression('NUM_GUIA');
        $where = new Expression("trim(NUM_GUIA) = " . "'$numero'");
        $query->select($select)->from('fac_guia')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        if ($data == true) {
            return 1;
        } else
            return 0;
    }

    public function EliminarGuiaDetalle($Codigo)
    {
        $connection = \Yii::$app->db;
        $eliminar = $connection->createCommand('DELETE FROM fac_guia_detal WHERE FAC_COD_GUIA = :FAC_COD_GUIA ');
        $eliminar->bindValue(':FAC_COD_GUIA', $Codigo);
        $resultado = $eliminar->query();
        return $resultado;
    }

    public function EliminarGuia($Codigo, $Usuario, $Fecha)
    {
        $connection = \Yii::$app->db;
        $eliminar = $connection->createCommand('UPDATE fac_guia SET USU_ELIM = :USU_ELIM , FECH_ELIM = :FECH_ELIM , COD_ESTA = :COD_ESTA WHERE COD_GUIA = :COD_GUIA');
        $eliminar->bindValue(':COD_GUIA', $Codigo);
        $eliminar->bindValue(':USU_ELIM', $Usuario);
        $eliminar->bindValue(':FECH_ELIM', $Fecha);
        $eliminar->bindValue(':COD_ESTA', 0);
        $resultado = $eliminar->query();
        return $resultado;
    }

    public function EliminarObra($Codigo, $Usuario, $Fecha)
    {
        $connection = \Yii::$app->db;
        $eliminar = $connection->createCommand('UPDATE obra SET USU_ELIM = :USU_ELIM , FEC_ELIM = :FEC_ELIM , COD_ESTA = :COD_ESTA WHERE NUM_OBRA = :NUM_OBRA');
        $eliminar->bindValue(':NUM_OBRA', $Codigo);
        $eliminar->bindValue(':USU_ELIM', $Usuario);
        $eliminar->bindValue(':FEC_ELIM', $Fecha);
        $eliminar->bindValue(':COD_ESTA', 0);
        $resultado = $eliminar->query();
        return $resultado;
    }

    public function EliminarObraGuia($Codigo, $Usuario, $Fecha)
    {
        $connection = \Yii::$app->db;
        $eliminar = $connection->createCommand('UPDATE detal_obra_guia SET USU_ELIM = :USU_ELIM , FECH_ELIM = :FECH_ELIM , COD_ESTADO = :COD_ESTADO WHERE NUM_GUIA = :NUM_GUIA');
        $eliminar->bindValue(':NUM_GUIA', $Codigo);
        $eliminar->bindValue(':USU_ELIM', $Usuario);
        $eliminar->bindValue(':FECH_ELIM', $Fecha);
        $eliminar->bindValue(':COD_ESTADO', 0);
        $resultado = $eliminar->query();
        return $resultado;
    }

    public function NumeroGuia($Codigo)
    {
        $query = new Query();
        $select = new Expression('NUM_GUIA');
        $query->select($select)->from('fac_guia')->where(['COD_GUIA' => $Codigo]);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function informacion($numeroGuia)
    {
        $query = new Query();
        $select = new Expression('*');
        $query->select($select)->from('fac_guia')->where(['COD_ESTA' => 1])->where(['NUM_GUIA' => $numeroGuia]);
        $comando = $query->createCommand();
        $resultado = $comando->queryAll();
        return $resultado;
    }

    public function ListObra()
    {
        $select[] = new Expression('DISTINCT NUM_OBRA AS value, NUM_OBRA AS label');
        $data = Guia::find()
            ->select($select)
            ->where(['COD_ESTA' => 1])
            ->asArray()
            ->all();
        return $data;
    }

    public function ListGuia()
    {
        $contenido = [];
        return $contenido;
    }

    public function ListaGuia($codigo)
    {
        $lista = Guia::find()->where("COD_ESTA = 1 and NUM_OBRA = '" . $codigo . "'")->orderBy(['NUM_GUIA' => SORT_ASC])->all();
        return $lista;
    }

}