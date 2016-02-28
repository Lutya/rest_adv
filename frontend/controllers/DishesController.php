<?php

namespace frontend\controllers;
use backend\models\dish\Dish;

class DishesController extends \yii\web\Controller
{
    public function actionIndex($dish_type_id)
    {
    	//$query = Dish::find();
    	$dishes = (new \yii\db\Query())// $query //
		    	->select(['dish.id', 'dish.name', 'price', 'count', 'measure_name' => 'measure.name'])
		    	->from('dish')
		    	->leftJoin('measure', 'measure.id = dish.measure_id')
		    	->where(['dish_type_id' => $dish_type_id])
		    	->all();
    	
        return $this->render('index', [
        		'dishes' => $dishes,
        ]);
    }

}
