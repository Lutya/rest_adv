<?php

namespace backend\models\dish;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\dish\Dish;

/**
 * DishSearch represents the model behind the search form about `backend\models\dish\Dish`.
 */
class DishSearch extends Dish
{
	public function attributes()
	{
		// add related fields to searchable attributes
		return array_merge(parent::attributes(), ['measure.name', 'dishType.name']);
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dish_type_id', 'measure_id'], 'integer'],
            [['name', 'note', 'measure.name', 'dishType.name'], 'safe'],
            [['count', 'price'], 'number'],
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
        $query = Dish::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith(['measure' => function($query) { $query->from(['measure']); }]);
        $query->joinWith(['dishType' => function($query) { $query->from(['dish_type']); }]);
        $query->andFilterWhere([
            'id' => $this->id,
            'dish_type_id' => $this->dish_type_id,
            'count' => $this->count,
            'measure_id' => $this->measure_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
        	->andFilterWhere(['like', 'measure.name', $this->getAttribute('measure.name')])
        	->andFilterWhere(['like', 'dish_type.name', $this->getAttribute('dishType.name')]);

        return $dataProvider;
    }
}
