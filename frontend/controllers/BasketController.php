<?php

namespace frontend\controllers;

use frontend\models\basket\Basket;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\GroupUrlRule;
use yii\web\NotFoundHttpException;

class BasketController extends \yii\web\Controller
{
    public function actionCreate($dish_id)//, $count)
    {
    	$cookies =  Yii::$app->request->cookies;
    	$session = Yii::$app->session;
    	$query = Basket::find()
    			->where(['id' => $cookies->get('id_bask'),
    					'dish_id' => $dish_id,])
    			->all();

    	if ($query) {
    		$basket = Basket::findOne(['id' => $cookies->get('id_bask'),
    						'dish_id' => $dish_id,]);
    		$basket->updateCounters(['count' => 1]);
    	}
    	else {
    		$basket = new Basket();
    		$basket->id = $cookies->get('id_bask');
    		$basket->dish_id = $dish_id;
    		$basket->count = 1;
    		$basket->date = date('Y-m-j');
    		$basket->save();
    	}
    	$session->setFlash('updatebasket', 'Добавлено в корзину');
    	return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
    	$this->findModel($id)->delete();
    	return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
    	if (($model = Basket::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

    public function actionEdit($type, $id_basket)
    {
    	$session = Yii::$app->session;
    	if($type == 'minus'){
    		$basket = Basket::findOne($id_basket);
    		if ($basket->count == 1) {
    			$this->findModel($id_basket)->delete();
    			$session->setFlash('editbasket', 'Удалено');
    		}
    		else {
    			$basket->updateCounters(['count' => -1]);
    			$session->setFlash('editbasket', 'Уменьшено');
    		}	
    	}	
    	elseif($type == 'plus'){
    		$basket = Basket::findOne($id_basket);
    		$basket->updateCounters(['count' => 1]);
    		$session->setFlash('editbasket', 'Добавлено');
    	}
    	else $session->setFlash('editbasket', 'Нет такой команды');
    	
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionIndex()
    {
    	$cookies =  Yii::$app->request->cookies;
    	$id_bask = $cookies->get('id_bask');
    	$query = Basket::find()
    			->where(['id' => $id_bask]);
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
        return $this->render('index', [
        		'dataProvider' => $dataProvider,
        		]);
    }

}
