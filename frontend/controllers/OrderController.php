<?php

namespace frontend\controllers;

use frontend\models\basket\Basket;
use Yii;
use yii\data\ActiveDataProvider;

class OrderController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$cookies =  Yii::$app->request->cookies;
    	$id_bask = $cookies->get('id_bask');
    	$query = Basket::find()
    		->where(['id' => $id_bask]);
    	$dataProvider = new ActiveDataProvider([
    		'query' => $query,
    	]);
    	 
    	 
    	$basket = Basket::findAll(['id' => $id_bask]);
    	$total_sum = 0;
    	foreach ($basket as $bas) {
    		$total_sum = $total_sum + $bas->count * $bas->price;
    	}
    	return $this->render('index', [
    		'dataProvider' => $dataProvider,
    		'total_sum' => $total_sum,
    	]);
    }

}
