<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penilaian;

/**
 * PenilaianSearch represents the model behind the search form of `app\models\Penilaian`.
 */
class PenilaianSearch extends Penilaian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_spk', 'id_alternatif'], 'integer'],
            [['penilaian', 'created_date', 'updated_date'], 'safe'],
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
        $query = Penilaian::find()->where(['id_spk' => $id_spk]);;
        $kriteria = \app\models\Kriteria::find()->where(['id_spk' => $id_spk])->all();

        // print_r($kriteria);die();

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
            'id_spk' => $this->id_spk,
            'id_alternatif' => $this->id_alternatif,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'penilaian', $this->penilaian]);

        return $dataProvider;
    }
}
