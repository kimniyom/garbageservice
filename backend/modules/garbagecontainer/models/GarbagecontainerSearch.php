<?php

namespace app\modules\garbagecontainer\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\garbagecontainer\models\Garbagecontainer;

/**
 * GarbagecontainerSearch represents the model behind the search form of `app\modules\garbagecontainer\models\Garbagecontainer`.
 */
class GarbagecontainerSearch extends Garbagecontainer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'garbagecontainer', 'size', 'brand', 'contain', 'color', 'detail'], 'safe'],
            [['price'], 'number'],
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
        $query = Garbagecontainer::find();

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
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'garbagecontainer', $this->garbagecontainer])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'contain', $this->contain])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
