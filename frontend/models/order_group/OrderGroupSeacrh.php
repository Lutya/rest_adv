<?php

namespace frontend\models\order_group;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\order_group\OrderGroup;

/**
 * OrderGroupSeacrh represents the model behind the search form about `frontend\models\order_group\OrderGroup`.
 */
class OrderGroupSeacrh extends OrderGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date', 'number'], 'safe'],
            [['order_status', 'group_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = OrderGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        

        $query->andFilterWhere([
            'group_id' => $this->group_id,
            'order_status' => 1,//$this->order_status,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'number', $this->number]);

        return $dataProvider;
    }
}
