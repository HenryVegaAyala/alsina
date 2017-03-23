<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mae_produ".
 *
 * @property integer $COD_MAE_CATG
 * @property integer $COD_MAE_PRODU
 * @property string $NUM_PROD
 * @property string $DESC_CORTAR
 * @property string $DESC_LARGA
 * @property string $PREC_X_DIA
 * @property string $PESO_REAL
 * @property string $PESO_VOL
 * @property integer $UD
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
 * @property FacGuiaDetal[] $facGuiaDetals
 * @property MaeCateg $cODMAECATG
 */
class MaeProdu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mae_produ';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COD_MAE_CATG'], 'required'],
            [['COD_MAE_CATG', 'UD'], 'integer'],
            [['PREC_X_DIA', 'PESO_REAL', 'PESO_VOL', 'PESO_REAL_TOTAL', 'CANT_DIAS', 'COST_TOTAL', 'PESO_V_TOTAL'], 'number'],
            [['FECH_DIGI', 'FECH_MODI', 'FECH_ELIM'], 'safe'],
            [['NUM_PROD', 'USU_DIGI', 'USU_MODI', 'USU_ELI', 'COD_ESTA'], 'string', 'max' => 45],
            [['DESC_CORTAR'], 'string', 'max' => 60],
            [['DESC_LARGA'], 'string', 'max' => 100],
            [['COD_MAE_CATG'], 'exist', 'skipOnError' => true, 'targetClass' => MaeCateg::className(), 'targetAttribute' => ['COD_MAE_CATG' => 'COD_MAE_CATG']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COD_MAE_CATG' => 'Cod  Mae  Catg',
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
    public function getFacGuiaDetals()
    {
        return $this->hasMany(FacGuiaDetal::className(), ['COD_MAE_PRODU' => 'COD_MAE_PRODU']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODMAECATG()
    {
        return $this->hasOne(MaeCateg::className(), ['COD_MAE_CATG' => 'COD_MAE_CATG']);
    }
}
