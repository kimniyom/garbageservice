<?php

namespace app\modules\customer\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\customer\models\Customer;

/**
 * CustomerSearch represents the model behind the search form of `app\modules\customer\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['CUSTOMERNAME', 'ADDRESS', 'OWNER', 'MOBILE', 'OFFICETEL', 'EMAIL', 'STATUS', 'APPROVE', 'CHANGWAT', 'AMPUR', 'TAMBON', 'ZIPCODE', 'CREATE_DATE', 'UPDATE_DATE', 'DATE_APPROVE'], 'safe'],
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
        $query = Customer::find();

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
            'ID' => $this->ID,
            'CREATE_DATE' => $this->CREATE_DATE,
            'UPDATE_DATE' => $this->UPDATE_DATE,
            'DATE_APPROVE' => $this->DATE_APPROVE,
        ]);

        $query->andFilterWhere(['like', 'CUSTOMERNAME', $this->CUSTOMERNAME])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'OWNER', $this->OWNER])
            ->andFilterWhere(['like', 'MOBILE', $this->MOBILE])
            ->andFilterWhere(['like', 'OFFICETEL', $this->OFFICETEL])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS])
            ->andFilterWhere(['like', 'APPROVE', $this->APPROVE])
            ->andFilterWhere(['like', 'CHANGWAT', $this->CHANGWAT])
            ->andFilterWhere(['like', 'AMPUR', $this->AMPUR])
            ->andFilterWhere(['like', 'TAMBON', $this->TAMBON])
            ->andFilterWhere(['like', 'ZIPCODE', $this->ZIPCODE]);

        return $dataProvider;
    }
}
