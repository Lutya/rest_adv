<?php

namespace frontend\controllers;

use frontend\models\basket\Basket;
use Yii;

class BasketController extends \yii\web\Controller
{
    public function actionCreate($dish_id, $count)
    {
    	$cookies =  Yii::$app->request->cookies;
    	$basket = new Basket();
    	$basket->id = $cookies->get('id_bask');
    	$basket->dish_id = $dish_id;
    	$basket->count = $count;
    	$basket->date = date('Y-m-j');
    	$basket->save();
        //return $this->render('create');
        

    	$session = Yii::$app->session;
    	// устанавливаем значение flash сообщения
    	$session->setFlash('addinbasket', 'Добавлено в корзину');
    	// проверяем наличие сообщения
    	//$result = $session->hasFlash('addinbasket');
    	// получаем и отображаем сообщение
    	echo $session->getFlash('addinbasket');
    	$user_id = $session->get('user_id');
    	echo $user_id;
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
