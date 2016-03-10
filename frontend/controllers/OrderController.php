<?php

namespace frontend\controllers;

use frontend\models\basket\Basket;
use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\orders\OrdersForm;
use frontend\models\orders\Orders;
use frontend\models\order_consist\OrderConsist;
use backend\models\user\User;

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
    	
    	$model = new OrdersForm();
    	
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		// данные в $model удачно проверены
    	
    		// делаем что-то полезное с $model ...
    		$username = Yii::$app->user->identity->username;
    		$user = User::findOne(['username' => $username]);
    		$message = 'Заказ отправлен. Менеджер с вами свяжется. Спасибо.';
    		if (!isset($user)) {
    			$message = 'Нужно сначала авторизироваться';
    		}
    		else {
    			//создаем заказ
    			$order_id = uniqid('OR');
    			$order = new Orders();
    			$order->id = $order_id;
    			$order->user_id = $user->id;
    			$order->order_status_id = 1;
    			$order->date = date('Y-m-j');
    			$order->number = $model->number;
    			$order->delivery = 0;
    			$order->save();	
    			
    			// переносим из корзины в состав заказа
    			foreach ($basket as $bas) {
    				$ord_cons = new OrderConsist();
    				$ord_cons->order_id = $order_id;
    				$ord_cons->dish_id = $bas->dish_id;
    				$ord_cons->count = $bas->count;
    				$ord_cons->save();
    			}				
    		}
    	
    		return $this->render('sendorder', ['model' => $model,
    				'message' => $message,
    		]);
    	} else {
    		// либо страница отображается первый раз, либо есть ошибка в данных
    		return $this->render('index', ['model' => $model,
    				'dataProvider' => $dataProvider,
    				'total_sum' => $total_sum,
    		]);
    	}
    	
    	
    	
    	/*return $this->render('index', [
    		'dataProvider' => $dataProvider,
    		'total_sum' => $total_sum,
    	]);*/
    }
    
   /* public function actionSendorder()
    {
    	$session = Yii::$app->session;
    	$user_id = $session['user_id'];
    	$message = 'Заказ отправлен';
    	if (!isset($user_id)) {
    		$message = 'Нужно сначала авторизироваться';
    	}
    	
    	return $this->render('sendorder', [
    			'message' => $message, 
    	]);
    }*/

}
