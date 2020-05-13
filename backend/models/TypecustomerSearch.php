<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Typecustomer;

/**
 * TypecustomerSearch represents the model behind the search form of `app\models\Typecustomer`.
 */
class TypecustomerSearch extends Typecustomer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['typename', 'typename_en', 'codenumber', 'description'], 'safe'],
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
        $query = Typecustomer::find();

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
        ]);

        $query->andFilterWhere(['like', 'typename', $this->typename])
            ->andFilterWhere(['like', 'typename_en', $this->typename_en])
            ->andFilterWhere(['like', 'codenumber', $this->codenumber])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
