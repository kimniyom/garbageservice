<?php

namespace app\modules\navbar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\navbar\models\Navbar;

/**
 * NavbarSearch represents the model behind the search form of `app\modules\navbar\models\Navbar`.
 */
class NavbarSearch extends Navbar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'submenu'], 'integer'],
            [['navbar', 'detail'], 'safe'],
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
        $query = Navbar::find();

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
            'submenu' => $this->submenu,
        ]);

        $query->andFilterWhere(['like', 'navbar', $this->navbar])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
