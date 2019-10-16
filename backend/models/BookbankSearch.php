<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bookbank;

/**
 * BookbankSearch represents the model behind the search form of `app\models\Bookbank`.
 */
class BookbankSearch extends Bookbank
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bank'], 'integer'],
            [['bookbanknumber', 'bookbankname', 'branch'], 'safe'],
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
    public function search($params)
    {
        $query = Bookbank::find();

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
            'bank' => $this->bank,
        ]);

        $query->andFilterWhere(['like', 'bookbanknumber', $this->bookbanknumber])
            ->andFilterWhere(['like', 'bookbankname', $this->bookbankname])
            ->andFilterWhere(['like', 'branch', $this->branch]);

        return $dataProvider;
    }
}
