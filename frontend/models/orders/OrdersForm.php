<?php
namespace frontend\models\orders;

use yii\base\Model;

class OrdersForm extends Model
{
	public $number;
	public $group;


	public function rules()
	{
		return [
				[['number'], 'required'],
				[['group'], 'safe'],
		];
	}
	
	public function attributeLabels()
	{
		return [
				'number' => 'Number of phone',
				'group' => 'Group',
		];
	}
}