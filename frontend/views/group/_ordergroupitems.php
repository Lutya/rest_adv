<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\models\order_group_consist\OrderGroupConsist;
use frontend\models\dish\Dish;
use frontend\models\order_consist\OrderConsistSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\order_consist\OrderConsistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],
            'user.username',
        	//'dish.price',
            'count',
            [
            	'label' => 'Sum',
            	'format' => 'raw',
            	'value' => function($data){
            		return ($data->count * $data->dish->price);
            	},
            	'contentOptions'=>[ 'style'=>'width: 100px'],
            ],
        ],
    ]); ?>

</div>
