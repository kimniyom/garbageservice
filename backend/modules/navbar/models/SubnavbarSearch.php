<?php

namespace app\modules\navbar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\navbar\models\Subnavbar;

/**
 * SubnavbarSearch represents the model behind the search form of `app\modules\navbar\models\Subnavbar`.
 */
class SubnavbarSearch extends Subnavbar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'navbar'], 'integer'],
            [['subnavbar', 'detail'], 'safe'],
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
        $query = Subnavbar::find();

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
            'navbar' => $this->navbar,
        ]);

        $query->andFilterWhere(['like', 'subnavbar', $this->subnavbar])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
