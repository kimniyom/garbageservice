<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Confirmform;

/**
 * ConfirmformSearch represents the model behind the search form of `app\models\Confirmform`.
 */
class ConfirmformSearch extends Confirmform
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customerid', 'typeform', 'roundkeep_sunday', 'roundkeep_monday', 'roundkeep_tueday', 'roundkeep_wednesday', 'roundkeep_thursday', 'roundkeep_friday', 'roundkeep_saturday', 'timeperiod', 'billdoc_originalinvoice', 'billdoc_copyofinvoice', 'billdoc_originalreceipt', 'billdoc_copyofreceipt', 'billdoc_copyofbank', 'billdoc_etc', 'paymentschedule', 'methodpeyment', 'sendtype'], 'integer'],
            [['confirmformnumber', 'roundkeep_day', 'timeperiod_time', 'billdoc_etctext', 'cyclekeepmoney'], 'safe'],
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
        $query = Confirmform::find();

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
            'typeform' => $this->typeform,
            'roundkeep_sunday' => $this->roundkeep_sunday,
            'roundkeep_monday' => $this->roundkeep_monday,
            'roundkeep_tueday' => $this->roundkeep_tueday,
            'roundkeep_wednesday' => $this->roundkeep_wednesday,
            'roundkeep_thursday' => $this->roundkeep_thursday,
            'roundkeep_friday' => $this->roundkeep_friday,
            'roundkeep_saturday' => $this->roundkeep_saturday,
            'roundkeep_day' => $this->roundkeep_day,
            'timeperiod' => $this->timeperiod,
            'timeperiod_time' => $this->timeperiod_time,
            'billdoc_originalinvoice' => $this->billdoc_originalinvoice,
            'billdoc_copyofinvoice' => $this->billdoc_copyofinvoice,
            'billdoc_originalreceipt' => $this->billdoc_originalreceipt,
            'billdoc_copyofreceipt' => $this->billdoc_copyofreceipt,
            'billdoc_copyofbank' => $this->billdoc_copyofbank,
            'billdoc_etc' => $this->billdoc_etc,
            'cyclekeepmoney' => $this->cyclekeepmoney,
            'paymentschedule' => $this->paymentschedule,
            'methodpeyment' => $this->methodpeyment,
            'sendtype' => $this->sendtype,
        ]);

        $query->andFilterWhere(['like', 'confirmformnumber', $this->confirmformnumber])
            ->andFilterWhere(['like', 'billdoc_etctext', $this->billdoc_etctext]);

        return $dataProvider;
    }
}
