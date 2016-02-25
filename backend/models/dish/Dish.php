<?php

namespace backend\models\dish;

use Yii;
use backend\models\dish_type\DishType;
use backend\models\measure\Measure;

/**
 * This is the model class for table "dish".
 *
 * @property integer $id
 * @property string $name
 * @property integer $dish_type_id
 * @property double $count
 * @property integer $measure_id
 * @property string $price
 * @property string $note
 *
 * @property DishType $dishType
 * @property Measure $measure
 */
class Dish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'count', 'price'], 'required'],
            [['dish_type_id', 'measure_id'], 'integer'],
            [['count', 'price'], 'number'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'dish_type_id' => 'Dish Type ID',
        	'dishType.name' => 'Dish type',
            'count' => 'Count',
            'measure_id' => 'Measure ID',
        	'measure.name' => 'Measure',
            'price' => 'Price',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishType()
    {
        return $this->hasOne(DishType::className(), ['id' => 'dish_type_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'measure_id']);
    }
}
