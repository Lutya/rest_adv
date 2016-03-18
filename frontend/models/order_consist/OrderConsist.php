<?php

namespace frontend\models\order_consist;

use Yii;
use backend\models\user\User;
use backend\models\dish\Dish;

/**
 * This is the model class for table "order_consist".
 *
 * @property integer $id
 * @property string $order_id
 * @property integer $dish_id
 * @property integer $count
 *
 * @property Dish $dish
 * @property Orders $order
 */
class OrderConsist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_consist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'count'], 'integer'],
            [['count'], 'required'],
            [['order_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'dish_id' => 'Dish ID',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
