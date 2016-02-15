<?php

namespace backend\models\measure;

use Yii;

/**
 * This is the model class for table "measure".
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 *
 * @property Dish[] $dishes
 */
class Measure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'measure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'full_name'], 'required'],
            [['full_name'], 'string'],
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
            'full_name' => 'Full Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasMany(Dish::className(), ['measure_id' => 'id']);
    }
}
