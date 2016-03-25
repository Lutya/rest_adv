<?php

namespace frontend\models\order_consist;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\order_consist\OrderConsist;
use frontend\models\orders\Orders;

/**
 * OrderConsistSearch represents the model behind the search form about `frontend\models\order_consist\OrderConsist`.
 */
class OrderConsistSearch extends OrderConsist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dish_id', 'count'], 'integer'],
            [['order_id'], 'safe'],
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
        $query = OrderConsist::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
       /* $query->joinWith('order');
        $query->joinWith('order.user');
        $query->joinWith('order.orderStatus');
        
        $dataProvider->setSort(['attributes'=>[
        		'order_id'=>[
        				'asc' => ['orders.date' => SORT_ASC],
        				'desc' => ['orders.date' => SORT_DESC],
        	],
        		'order.user_id'=>[
        				'asc' => ['user.username' => SORT_ASC],
        				'desc' => ['user.username' => SORT_DESC],
        		]
        ]]);*/

        /*$dataProvider->sort->attributes['order.date'] = [
        		'asc' => ['order.date' => SORT_ASC],
        		'desc' => ['order.date' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['order.user.username'] = [
        		'asc' => ['user.username' => SORT_ASC],
        		'desc' => ['user.username' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['order.orderStatus.name'] = [
        		'asc' => ['order_status.name' => SORT_ASC],
        		'desc' => ['order_status.name' => SORT_DESC],
        ];*/
        
        

        $query->andFilterWhere([
            'id' => $this->id,
            'dish_id' => $this->dish_id,
            'count' => $this->count,
        	//'orders.user.username' => $this->order->user->username,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id]);
        	//->andFilterWhere(['like', 'orders.date', $this->order_id]);
        	//->andFilterWhere(['like', 'user.username', $this->order_id]);

        return $dataProvider;
    }
}
