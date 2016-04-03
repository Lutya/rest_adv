<?php

namespace frontend\models\entry;

use Yii;
use frontend\models\user_group\UserGroup;
use backend\models\user\User;

/**
 * This is the model class for table "entry".
 *
 * @property integer $user_id
 * @property integer $group_id
 * @property string $date
 * @property integer $status_user
 *
 * @property UserGroup $group
 * @property User $user
 */
class Entry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id', 'status_user'], 'integer'],
            [['date'], 'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
            'date' => 'Date',
            'status_user' => 'Status User',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
