<?php

namespace frontend\models\order_group;

use Yii;
use frontend\models\user_group\UserGroup;
use frontend\models\order_group_consist\OrderGroupConsist;


/**
 * This is the model class for table "order_group".
 *
 * @property string $id
 * @property integer $group_id
 * @property integer $order_status
 * @property string $date
 * @property string $number
 *
 * @property UserGroup $group
 * @property OrderGroupConsist[] $orderGroupConsists
 */
class OrderGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['group_id', 'order_status'], 'integer'],
            [['date'], 'safe'],
            [['id'], 'string', 'max' => 15],
            [['number'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'order_status' => 'Order Status',
            'date' => 'Date',
            'number' => 'Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(UserGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderGroupConsists()
    {
        return $this->hasMany(OrderGroupConsist::className(), ['order_group_id' => 'id']);
    }
}
