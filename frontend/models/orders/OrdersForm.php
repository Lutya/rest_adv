<?php
namespace frontend\models\orders;

use yii\base\Model;

class OrdersForm extends Model
{
	public $number;


	public function rules()
	{
		return [
				[['number'], 'required'],
		];
	}
}