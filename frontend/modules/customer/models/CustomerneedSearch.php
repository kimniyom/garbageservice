<?php

namespace app\modules\customer\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\customer\models\Customerneed;

/**
 * CustomerneedSearch represents the model behind the search form of `app\modules\customer\models\Customerneed`.
 */
class CustomerneedSearch extends Customerneed {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'customrttype', 'roundofweek', 'roundofmount', 'priceofmount', 'priceofyear', 'typebill', 'roundprice'], 'integer'],
            [['title', 'customername', 'address', 'tel', 'contact', 'dayopen', 'location', 'detail', 'd_update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Customerneed::find();

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
            'customrttype' => $this->customrttype,
            'roundofweek' => $this->roundofweek,
            'roundofmount' => $this->roundofmount,
            'priceofmount' => $this->priceofmount,
            'priceofyear' => $this->priceofyear,
            'typebill' => $this->typebill,
            'roundprice' => $this->roundprice,
            'd_update' => $this->d_update,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'customername', $this->customername])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'tel', $this->tel])
                ->andFilterWhere(['like', 'contact', $this->contact])
                ->andFilterWhere(['like', 'dayopen', $this->dayopen])
                ->andFilterWhere(['like', 'location', $this->location])
                ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }

}
