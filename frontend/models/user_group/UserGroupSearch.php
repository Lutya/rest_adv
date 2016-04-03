<?php

namespace frontend\models\user_group;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\user_group\UserGroup;

/**
 * UserGroupSearch represents the model behind the search form about `frontend\models\user_group\UserGroup`.
 */
class UserGroupSearch extends UserGroup
{
	public $owner;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'owner_id'], 'integer'],
            [['name', 'date', 'owner'], 'safe'],
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
        $query = UserGroup::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        	'pagination' => [
        				'pageSize' => 25,
        	],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('owner');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            //'owner_id' => $this->owner_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
        		->andFilterWhere(['like', 'user.username', $this->owner]);

        return $dataProvider;
    }
}
