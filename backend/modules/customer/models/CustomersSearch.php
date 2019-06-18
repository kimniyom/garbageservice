<?php

namespace app\modules\customer\models;

use app\modules\customer\models\Customers;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CustomersSearch represents the model behind the search form of `app\modules\customer\models\Customers`.
 */
class CustomersSearch extends Customers {
	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[['id'], 'integer'],
			[['company', 'taxnumber', 'address', 'changwat', 'ampur', 'tambon', 'zipcode', 'manager', 'tel', 'telephone', 'flag', 'create_date', 'update_date', 'approve'], 'safe'],
			[['user_id'], 'number'],
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
		$query = Customers::find();

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
			'create_date' => $this->create_date,
			'update_date' => $this->update_date,
		]);

		$query->andFilterWhere(['like', 'company', $this->company])
			->andFilterWhere(['like', 'taxnumber', $this->taxnumber])
			->andFilterWhere(['like', 'address', $this->address])
			->andFilterWhere(['like', 'changwat', $this->changwat])
			->andFilterWhere(['like', 'ampur', $this->ampur])
			->andFilterWhere(['like', 'tambon', $this->tambon])
			->andFilterWhere(['like', 'zipcode', $this->zipcode])
			->andFilterWhere(['like', 'manager', $this->manager])
			->andFilterWhere(['like', 'tel', $this->tel])
			->andFilterWhere(['like', 'telephone', $this->telephone])
			->andFilterWhere(['like', 'flag', $this->flag])
			->andFilterWhere(['like', 'approve', $this->approve]);

		return $dataProvider;
	}
}
