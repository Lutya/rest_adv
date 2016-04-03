<?php

namespace frontend\controllers;

use frontend\models\basket\Basket;
use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\orders\OrdersForm;
use frontend\models\orders\Orders;
use frontend\models\order_consist\OrderConsist;
use frontend\models\order_group\OrderGroup;
use frontend\models\order_group_consist\OrderGroupConsist;
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
    		$username = Yii::$app->user->identity->username;
    		$user = User::findOne(['username' => $username]);
    		$message = 'Заказ отправлен. Менеджер с вами свяжется. Спасибо.'. $model->group;
    		if (!isset($user)) {
    			$message = 'Нужно сначала авторизироваться';
    		}
    		else {
    			//проверяем был ли указан груповой заказ
    			//если нет
    			if (!isset($model->group)) {
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
    			// если указан групповой заказ
    			else {
    				$ord_gr = OrderGroup::find()
    					->where([
    							'group_id' => $model->group,
    							'order_status' => 0,
    					]);
    				$pres_ord_group = $ord_gr->count();
    				//если групповой заказ еще не создан
    				if ($pres_ord_group == 0) {
    					$order_group_id = uniqid('OR');
    					$order_group = new OrderGroup();
    					$order_group->id = $order_group_id;
    					$order_group->group_id = $model->group;
    					$order_group->order_status = 0;
    					$order_group->date = date('Y-m-j');
    					$order_group->number = $model->number;
    					$order_group->save();
    					
    					// переносим из корзины в состав группового заказа
    					foreach ($basket as $bas) {
    						$ord_group_cons = new OrderGroupConsist();
    						$ord_group_cons->order_group_id = $order_group_id;
    						$ord_group_cons->dish_id = $bas->dish_id;
    						$ord_group_cons->count = $bas->count;
    						$ord_group_cons->user_id = Yii::$app->user->identity->id;
    						$ord_group_cons->save();
    					
    					}
    				}
    				//если заказ уже создан
    				else {
    					$ord_gr = $ord_gr->one();
    					$ord_gr_id = $ord_gr->id;
    					
    					// переносим из корзины в состав группового заказа
    					foreach ($basket as $bas) {
    						$count_dish = OrderGroupConsist::find()
    							->where([
    									'user_id' => Yii::$app->user->identity->id,
    									'dish_id' => $bas->dish_id,
    									'order_group_id' => $ord_gr_id,
    							])
    							->count();
    						//если в груповом заказе еще нет такого блюда от этого пользователя
    						if ($count_dish == 0){
    							$ord_group_cons = new OrderGroupConsist();
    							$ord_group_cons->order_group_id = $ord_gr_id;
    							$ord_group_cons->dish_id = $bas->dish_id;
    							$ord_group_cons->count = $bas->count;
    							$ord_group_cons->user_id = Yii::$app->user->identity->id;
    							$ord_group_cons->save();
    						}
    						//если есть уже блюдо
    						else {
    							$ord_gr_cons = OrderGroupConsist::findOne([
    									'user_id' => Yii::$app->user->identity->id,
    									'order_group_id' => $ord_gr_id,
    									'dish_id' => $bas->dish_id,
    							]);
    							$ord_gr_cons->updateCounters(['count' => $bas->count]);
    						}									
    					}			
    				}
    				
    				$message = 'Групповой заказ был отправлен!';
    				
    			}	
    				
    			//удаляем корзину
    			Basket::deleteAll(['id' => $id_bask]);
    			
    			//создаем новый ИД корзины
    			$cookies_resp = Yii::$app->response->cookies;
    			$uniq_id = uniqid('ID');
    			$cookies_resp->add(new \yii\web\Cookie([
    					'name' => 'id_bask',
    					'value' => $uniq_id,
    					'expire' => time()+60*60*24*24,
    			]));
    							
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
