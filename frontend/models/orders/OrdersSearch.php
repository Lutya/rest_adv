<?php

namespace frontend\models\orders;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\orders\Orders;

/**
 * OrdersSearch represents the model behind the search form about `frontend\models\orders\Orders`.
 */
class OrdersSearch extends Orders
{
	public $statusName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date', 'user_id', 'number', 'order_status_id', 'statusName'], 'safe'],
            [['delivery'], 'integer'],
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
        $query = Orders::find()
        	//->where(['date'=>date('Y-m-j')])
        	->orderBy([
        				'date'=> SORT_DESC, 
        				'order_status_id'=>SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('orderStatus');
        $query->joinWith('user');
        
        $query->andFilterWhere([
            //'user_id' => $this->user_id,
        	//'orderStatus.name' =>  $this->order_status_id,
            //'order_status_id' => $this->order_status_id,
            'date' => $this->date,
            'delivery' => $this->delivery,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'number', $this->number])
       		->andFilterWhere(['like', 'orderStatus', $this->orderStatus])
        	->andFilterWhere(['like', 'order_status.name', $this->order_status_id])
        	->andFilterWhere(['like', 'user.username', $this->user_id]);

        return $dataProvider;
    }
}
