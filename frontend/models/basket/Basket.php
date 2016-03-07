<?php

namespace frontend\models\basket;

use Yii;
use backend\models\dish\Dish;

/**
 * This is the model class for table "basket".
 *
 * @property integer $id
 * @property integer $dish_id
 * @property integer $count
 * @property string $date
 *
 * @property Dish $dish
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'count'], 'integer'],
            [['count', 'date'], 'required'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_id' => 'Dish ID',
        	'dish.name' => 'Dish name',
            'count' => 'Count',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['id' => 'dish_id']);
    }
}
