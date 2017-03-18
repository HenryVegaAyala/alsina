<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
/**
 * This is the model class for table "obra".
 *
 * @property integer $COD_OBRA
 * @property string $NUM_OBRA
 * @property string $FEC_DIGI
 * @property string $FEC_MODI
 * @property string $FEC_ELIM
 * @property string $USU_DIGI
 * @property string $USU_MODI
 * @property string $USU_ELIM
 * @property string $COD_ESTA
 *
 * @property DetalObraGuia[] $detalObraGuias
 */
class Obra extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'obra';
    }

    public function rules()
    {
        return [
            [['FEC_DIGI', 'FEC_MODI', 'FEC_ELIM'], 'safe'],
            [['NUM_OBRA'], 'string', 'max' => 12],
            [['USU_DIGI', 'USU_MODI', 'USU_ELIM'], 'string', 'max' => 45],
            [['COD_ESTA'], 'string', 'max' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'COD_OBRA' => 'Cod  Obra',
            'NUM_OBRA' => 'Num  Obra',
            'FEC_DIGI' => 'Fec  Digi',
            'FEC_MODI' => 'Fec  Modi',
            'FEC_ELIM' => 'Fec  Elim',
            'USU_DIGI' => 'Usu  Digi',
            'USU_MODI' => 'Usu  Modi',
            'USU_ELIM' => 'Usu  Elim',
            'COD_ESTA' => 'Cod  Esta',
        ];
    }

    public function getDetalObraGuias()
    {
        return $this->hasMany(DetalObraGuia::className(), ['OBRA_COD_OBRA' => 'COD_OBRA']);
    }

    public function getCodigoObra()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(COD_OBRA), 0) + 1');
        $query->select($expresion)->from('obra');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}
