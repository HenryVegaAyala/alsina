<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;

/**
 * This is the model class for table "detal_obra_guia".
 *
 * @property integer $COD_OBRA_GUIA
 * @property string $NUM_GUIA
 * @property string $NUM_OBRA
 * @property integer $GUIA_COD_GUIA
 * @property integer $OBRA_COD_OBRA
 * @property string $FECH_DIGI
 * @property string $FECH_MODI
 * @property string $FECH_ELIM
 * @property string $USU_DIGI
 * @property string $USU_MODI
 * @property string $USU_ELIM
 * @property string $COD_ESTADO
 *
 * @property FacGuia $gUIACODGUIA
 * @property Obra $oBRACODOBRA
 */
class DetalObraGuia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detal_obra_guia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COD_OBRA_GUIA', 'GUIA_COD_GUIA', 'OBRA_COD_OBRA'], 'required'],
            [['COD_OBRA_GUIA', 'GUIA_COD_GUIA', 'OBRA_COD_OBRA'], 'integer'],
            [['FECH_DIGI', 'FECH_MODI', 'FECH_ELIM'], 'safe'],
            [['NUM_GUIA', 'NUM_OBRA'], 'string', 'max' => 15],
            [['USU_DIGI', 'USU_MODI', 'USU_ELIM'], 'string', 'max' => 45],
            [['COD_ESTADO'], 'string', 'max' => 1],
            [
                ['GUIA_COD_GUIA'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Guia::className(),
                'targetAttribute' => ['GUIA_COD_GUIA' => 'COD_GUIA'],
            ],
            [
                ['OBRA_COD_OBRA'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Obra::className(),
                'targetAttribute' => ['OBRA_COD_OBRA' => 'COD_OBRA'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COD_OBRA_GUIA' => 'Cod  Obra  Guia',
            'NUM_GUIA' => 'Num  Guia',
            'NUM_OBRA' => 'Num  Obra',
            'GUIA_COD_GUIA' => 'Guia  Cod  Guia',
            'OBRA_COD_OBRA' => 'Obra  Cod  Obra',
            'FECH_DIGI' => 'Fech  Digi',
            'FECH_MODI' => 'Fech  Modi',
            'FECH_ELIM' => 'Fech  Elim',
            'USU_DIGI' => 'Usu  Digi',
            'USU_MODI' => 'Usu  Modi',
            'USU_ELIM' => 'Usu  Elim',
            'COD_ESTADO' => 'Cod  Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGUIACODGUIA()
    {
        return $this->hasOne(FacGuia::className(), ['COD_GUIA' => 'GUIA_COD_GUIA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOBRACODOBRA()
    {
        return $this->hasOne(Obra::className(), ['COD_OBRA' => 'OBRA_COD_OBRA']);
    }

    public function getCodigoObraGuia()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(COD_OBRA_GUIA), 0) + 1');
        $query->select($expresion)->from('detal_obra_guia');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        return $data;
    }
}