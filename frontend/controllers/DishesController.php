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
    	$session = Yii::$app->session;
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
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		echo $session->getFlash('updatebasket');
        return $this->render('index', [
        		'dataProvider' => $dataProvider,
        		'searchModel' => $searchModel,
        ]);
    }
}
