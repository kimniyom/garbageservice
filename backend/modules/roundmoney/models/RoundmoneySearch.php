<?php

namespace app\modules\roundmoney\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\roundmoney\models\Roundmoney;

/**
 * RoundmoneySearch represents the model behind the search form of `app\modules\roundmoney\models\Roundmoney`.
 */
class RoundmoneySearch extends Roundmoney
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customerid', 'promiseid', 'round', 'amount'], 'integer'],
            [['datekeep', 'keepby', 'status', 'receiptnumber'], 'safe'],
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
        $query = Roundmoney::find();

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
            'customerid' => $this->customerid,
            'promiseid' => $this->promiseid,
            'datekeep' => $this->datekeep,
            'round' => $this->round,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'keepby', $this->keepby])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'receiptnumber', $this->receiptnumber]);

        return $dataProvider;
    }
}
