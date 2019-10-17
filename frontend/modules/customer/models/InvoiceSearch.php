<?php

namespace app\modules\customer\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\customer\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form of `app\modules\customer\models\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'promise', 'round', 'status', 'type', 'typeinvoice', 'bank'], 'integer'],
            [['invoicenumber', 'month', 'year', 'd_update', 'timeservice', 'dateservice', 'comment', 'dateinvoice', 'datebill', 'slip'], 'safe'],
            [['total'], 'number'],
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
        $query = Invoice::find();

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
            'promise' => $this->promise,
            'round' => $this->round,
            'total' => $this->total,
            'status' => $this->status,
            'd_update' => $this->d_update,
            'dateservice' => $this->dateservice,
            'type' => $this->type,
            'dateinvoice' => $this->dateinvoice,
            'datebill' => $this->datebill,
            'typeinvoice' => $this->typeinvoice,
            'bank' => $this->bank,
        ]);

        $query->andFilterWhere(['like', 'invoicenumber', $this->invoicenumber])
            ->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'timeservice', $this->timeservice])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'slip', $this->slip]);

        return $dataProvider;
    }
}
