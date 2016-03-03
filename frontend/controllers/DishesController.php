<?php

namespace frontend\controllers;

use Yii;
use backend\models\dish\Dish;
use backend\models\dish\DishSearch;
use yii\data\ActiveDataProvider;
use frontend\models\CountForm;

class DishesController extends \yii\web\Controller
{
    public function actionIndex($dish_type_id)
    {
    	$searchModel = new DishSearch(
    			['dish_type_id' => $dish_type_id,]);
    	$query = Dish::find()->where(['dish_type_id' => $dish_type_id]);
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	
    	$query->joinWith(['measure' => function($query) { $query->from(['measure']); }]);
    	// enable sorting for the related column
    	$dataProvider->sort->attributes['measure.name'] = [
    			'asc' => ['measure.name' => SORT_ASC],
    			'desc' => ['measure.name' => SORT_DESC],
    	];  	
    	
    	//$query = Dish::find();
    	$dishes = (new \yii\db\Query())// $query //
		    	->select(['dish.id', 'dish.name', 'price', 'count', 'measure_name' => 'measure.name'])
		    	->from('dish')
		    	->leftJoin('measure', 'measure.id = dish.measure_id')
		    	->where(['dish_type_id' => $dish_type_id])
		    	->all();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$model = new CountForm();
		
        return $this->render('index', [
        		'dishes' => $dishes,
        		'dataProvider' => $dataProvider,
        		'searchModel' => $searchModel,
        		'model' => $model,
        ]);
    }
}
