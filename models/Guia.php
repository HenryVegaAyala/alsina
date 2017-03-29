<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;

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
 *
 * @property DetalObraGuia[] $detalObraGuias
 * @property FacGuiaDetal[] $facGuiaDetals
 */
class Guia extends \yii\db\ActiveRecord
{

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
            [['COD_ESTA'], 'string', 'max' => 1],

            [['NUM_OBRA'], 'required', 'message' => 'N° de Obra es necesario.'],
            [['NUM_GUIA'], 'required', 'message' => 'N° de Guía es necesario.'],
            [['DI_GRACIA'], 'required', 'message' => 'N° de Días es necesario.'],

            [['NUM_GUIA'], 'integer', 'message' => 'Debe de ser númerico.'],
            [['NUM_GUIA'], 'match', 'pattern' => "/^.{6,6}$/", 'message' => 'Debe de tener 6 digitos.'],
            [['NUM_GUIA'], 'string', 'max' => 6],

            [['DI_GRACIA'], 'number', 'message' => 'Debe de ser númerico.'],
            [['DI_GRACIA'], 'string', 'max' => 3],
            [['DI_GRACIA'], 'match', 'pattern' => "/^.{1,3}$/", 'message' => 'Mínimo 1 digito.'],

            ['FECH_CORTE', 'compare', 'compareAttribute' => 'FECH_LLEGA', 'operator' => '>=', 'message' => 'Debe ser igual mayor a Fecha de Llegada.'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'COD_GUIA' => 'Código de Guía',
            'NUM_OBRA' => 'Número  Obra',
            'NUM_GUIA' => 'Número  Guía',
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
        $query->select($expresion)->from('fac_guia_detal')->where(["FAC_COD_GUIA" => $Codigo ]);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function MontoGuiaElemento($Codigo)
    {
        $query = new Query();
        $expresion = new Expression('sum(COST_TOTAL) AS TOTAL');
        $query->select($expresion)->from('fac_guia_detal')->where(["COD_CATG" => $Codigo ]);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

}