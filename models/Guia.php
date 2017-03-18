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
            [['DI_GRACIA'], 'match', 'pattern' => "/^.{1}$/", 'message' => 'Debe de ser 1 digito.'],
            [['DI_GRACIA'], 'string', 'max' => 1],

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
}