<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;

/**
 * This is the model class for table "fac_guia_detal".
 *
 * @property integer $COD_GUIA_DETAL
 * @property integer $FAC_COD_GUIA
 * @property integer $COD_CATG
 * @property integer $COD_MAE_PRODU
 * @property string $NUM_PROD
 * @property string $DESC_CORTAR
 * @property string $DESC_LARGA
 * @property string $PREC_X_DIA
 * @property string $PESO_REAL
 * @property string $PESO_VOL
 * @property string $UD
 * @property string $PESO_REAL_TOTAL
 * @property string $CANT_DIAS
 * @property string $COST_TOTAL
 * @property string $PESO_V_TOTAL
 * @property string $FECH_DIGI
 * @property string $FECH_MODI
 * @property string $FECH_ELIM
 * @property string $USU_DIGI
 * @property string $USU_MODI
 * @property string $USU_ELI
 * @property string $COD_ESTA
 *
 * @property FacGuia $fACCODGUIA
 * @property MaeProdu $cODMAEPRODU
 */
class FacGuiaDetal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fac_guia_detal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FAC_COD_GUIA', 'COD_CATG', 'COD_MAE_PRODU'], 'required'],
            [['FAC_COD_GUIA', 'COD_CATG', 'COD_MAE_PRODU'], 'integer'],
            [
                [
                    'PREC_X_DIA',
                    'PESO_REAL',
                    'PESO_VOL',
                    'UD',
                    'PESO_REAL_TOTAL',
                    'CANT_DIAS',
                    'COST_TOTAL',
                    'PESO_V_TOTAL',
                ],
                'number',
            ],
            [['FECH_DIGI', 'FECH_MODI', 'FECH_ELIM'], 'safe'],
            [['NUM_PROD', 'USU_DIGI', 'USU_MODI', 'USU_ELI', 'COD_ESTA'], 'string', 'max' => 45],
            [['DESC_CORTAR', 'DESC_LARGA'], 'string', 'max' => 100],
            [
                ['FAC_COD_GUIA'],
                'exist',
                'skipOnError' => true,
                'targetClass' => FacGuia::className(),
                'targetAttribute' => ['FAC_COD_GUIA' => 'COD_GUIA'],
            ],
            [
                ['COD_MAE_PRODU'],
                'exist',
                'skipOnError' => true,
                'targetClass' => MaeProdu::className(),
                'targetAttribute' => ['COD_MAE_PRODU' => 'COD_MAE_PRODU'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COD_GUIA_DETAL' => 'Cod  Guia  Detal',
            'FAC_COD_GUIA' => 'Fac  Cod  Guia',
            'COD_CATG' => 'Cod  Catg',
            'COD_MAE_PRODU' => 'Cod  Mae  Produ',
            'NUM_PROD' => 'Num  Prod',
            'DESC_CORTAR' => 'Desc  Cortar',
            'DESC_LARGA' => 'Desc  Larga',
            'PREC_X_DIA' => 'Prec  X  Dia',
            'PESO_REAL' => 'Peso  Real',
            'PESO_VOL' => 'Peso  Vol',
            'UD' => 'Ud',
            'PESO_REAL_TOTAL' => 'Peso  Real  Total',
            'CANT_DIAS' => 'Cant  Dias',
            'COST_TOTAL' => 'Cost  Total',
            'PESO_V_TOTAL' => 'Peso  V  Total',
            'FECH_DIGI' => 'Fech  Digi',
            'FECH_MODI' => 'Fech  Modi',
            'FECH_ELIM' => 'Fech  Elim',
            'USU_DIGI' => 'Usu  Digi',
            'USU_MODI' => 'Usu  Modi',
            'USU_ELI' => 'Usu  Eli',
            'COD_ESTA' => 'Cod  Esta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFACCODGUIA()
    {
        return $this->hasOne(FacGuia::className(), ['COD_GUIA' => 'FAC_COD_GUIA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODMAEPRODU()
    {
        return $this->hasOne(MaeProdu::className(), ['COD_MAE_PRODU' => 'COD_MAE_PRODU']);
    }

    public function getCodigoGuiaDetal()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(COD_GUIA_DETAL), 0) + 1');
        $query->select($expresion)->from('fac_guia_detal');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        return $data;
    }
}