<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kriteria;

/**
 * KriteriaSearch represents the model behind the search form of `app\models\Kriteria`.
 */
class KriteriaSearch extends Kriteria
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'id_spk'], 'integer'],
            [['nama_kriteria', 'created_date', 'updated_date'], 'safe'],
            [['bobot'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($id_spk, $params)
    {
        $query = Kriteria::find()->where(['id_spk' => $id_spk]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'bobot' => $this->bobot,
            'id_spk' => $this->id_spk,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'nama_kriteria', $this->nama_kriteria]);

        return $dataProvider;
    }
}
