<?php

namespace frontend\controllers;

use frontend\models\basket\Basket;

class BasketController extends \yii\web\Controller
{
    public function actionCreate($dish_id, $count)
    {
    	$basket = new Basket();
    	$basket->dish_id = $dish_id;
    	$basket->count = $count;
    	$basket->date = date('Y-m-j');
    	$basket->save();
        //return $this->render('create');
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
