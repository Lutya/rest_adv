<?php

namespace frontend\models\order_group_consist;

use Yii;
use frontend\models\order_group\OrderGroup;
use backend\models\user\User;
use backend\models\dish\Dish;


/**
 * This is the model class for table "order_group_consist".
 *
 * @property integer $id
 * @property string $order_group_id
 * @property integer $dish_id
 * @property integer $count
 * @property integer $user_id
 *
 * @property Dish $dish
 * @property OrderGroup $orderGroup
 * @property User $user
 */
class OrderGroupConsist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_group_consist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'count', 'user_id'], 'integer'],
            [['count'], 'required'],
            [['order_group_id'], 'string', 'max' => 255],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::className(), 'targetAttribute' => ['dish_id' => 'id']],
            [['order_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderGroup::className(), 'targetAttribute' => ['order_group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_group_id' => 'Order Group ID',
            'dish_id' => 'Dish ID',
            'count' => 'Count',
            'user_id' => 'User ID',
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
    public function getOrderGroup()
    {
        return $this->hasOne(OrderGroup::className(), ['id' => 'order_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
