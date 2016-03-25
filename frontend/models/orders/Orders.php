<?php

namespace frontend\models\orders;

use Yii;
use backend\models\user\User;
use frontend\models\order_status\OrderStatus;
use frontend\models\order_consist\OrderConsist;
/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $order_status_id
 * @property string $date
 * @property string $number
 * @property integer $delivery
 *
 * @property OrderConsist[] $orderConsists
 * @property OrderStatus $orderStatus
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'user_id', 'order_status_id', 'date'], 'required'],
            [['user_id', 'order_status_id', 'delivery'], 'integer'],
            [['date', 'number'], 'safe'],
            [['id'], 'string', 'max' => 15],
            [['number'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_status_id' => 'Order Status ID',
        	//'orderStatus.name' => 'Name order status',
            'date' => 'Date',
            'number' => 'Number',
            'delivery' => 'Delivery',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderConsists()
    {
        return $this->hasMany(OrderConsist::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'order_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    } 
}
