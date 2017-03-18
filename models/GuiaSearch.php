<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Guia;

/**
 * GuiaSearch represents the model behind the search form about `app\models\Guia`.
 */
class GuiaSearch extends Guia
{
    public function rules()
    {
        return [
            [['COD_GUIA', 'OBRA_COD_OBRA'], 'integer'],
            [['NUM_GUIA', 'FECH_LLEGA', 'FECH_CORTE', 'FECH_DIGI', 'FECH_MODI', 'FECH_ELIM', 'USU_DIGI', 'USU_MODI', 'USU_ELIM', 'COD_ESTA'], 'safe'],
            [['DI_GRACIA'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Guia::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'COD_GUIA' => $this->COD_GUIA,
            'OBRA_COD_OBRA' => $this->OBRA_COD_OBRA,
            'FECH_LLEGA' => $this->FECH_LLEGA,
            'FECH_CORTE' => $this->FECH_CORTE,
            'DI_GRACIA' => $this->DI_GRACIA,
            'FECH_DIGI' => $this->FECH_DIGI,
            'FECH_MODI' => $this->FECH_MODI,
            'FECH_ELIM' => $this->FECH_ELIM,
        ]);

        $query->andFilterWhere(['like', 'NUM_GUIA', $this->NUM_GUIA])
            ->andFilterWhere(['like', 'USU_DIGI', $this->USU_DIGI])
            ->andFilterWhere(['like', 'USU_MODI', $this->USU_MODI])
            ->andFilterWhere(['like', 'USU_ELIM', $this->USU_ELIM])
            ->andFilterWhere(['like', 'COD_ESTA', $this->COD_ESTA]);

        return $dataProvider;
    }
}
