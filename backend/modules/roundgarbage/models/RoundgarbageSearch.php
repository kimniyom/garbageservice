<?php

namespace app\modules\roundgarbage\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\roundgarbage\models\Roundgarbage;

/**
 * RoundgarbageSearch represents the model behind the search form of `app\modules\roundgarbage\models\Roundgarbage`.
 */
class RoundgarbageSearch extends Roundgarbage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customerid', 'promiseid', 'round', 'amount'], 'integer'],
            [['datekeep', 'keepby', 'status'], 'safe'],
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
        $query = Roundgarbage::find();

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
            'id' => $this->id,
            'datekeep' => $this->datekeep,
            'round' => $this->round,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'keepby', $this->keepby])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
