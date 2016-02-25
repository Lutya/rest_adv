<?php

namespace backend\controllers;

use backend\models\dish_type\DishType;
use backend\models\dish\Dish;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

class MenyController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						//'only' => ['create', 'update'],
						'rules' => [
								[
										//'actions' => ['create', 'delete', 'update', 'view'],
										'allow' => true,
										'actions' => ['open', 'index'],
										'roles' => ['manager'],
								],
						],
				],
		];
	}
	
    public function actionIndex()
    {
    	$query = DishType::find();
    	$dish_types = $query->orderBy('name')->all();
    	
    	return $this->render('index', [
                'dish_types' => $dish_types,
            	]);
    }
    
    public function actionOpen($id)
    {
    	$dataProvider = new ActiveDataProvider([
    			'query' => Dish::find()->where(['dish_type_id' => $id]),
    	]);
    	 	   	
    	return $this->render('open', [
            'dataProvider' => $dataProvider,
        ]
    			);
    }

}
