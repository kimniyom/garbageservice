<?php

namespace app\modules\promise\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\promise\models\Promise;

/**
 * PromiseSearch represents the model behind the search form of `app\modules\promise\models\Promise`.
 */
class PromiseSearch extends Promise
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'promisedatebegin', 'promisedateend', 'recivetype', 'ratetext', 'payperyeartext', 'createat'], 'safe'],
            [['customerid', 'rate', 'levy', 'payperyear'], 'integer'],
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
        $query = Promise::find();

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
            'customerid' => $this->customerid,
            'promisedatebegin' => $this->promisedatebegin,
            'promisedateend' => $this->promisedateend,
            'rate' => $this->rate,
            'levy' => $this->levy,
            'payperyear' => $this->payperyear,
            'createat' => $this->createat,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'recivetype', $this->recivetype])
            ->andFilterWhere(['like', 'ratetext', $this->ratetext])
            ->andFilterWhere(['like', 'payperyeartext', $this->payperyeartext]);

        return $dataProvider;
    }
}
