<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\models\order_consist\OrderConsist;
use frontend\models\dish\Dish;
use frontend\models\order_consist\OrderConsistSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\order_consist\OrderConsistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],
        	[
        		'label' => 'Photo',
        		'format' => 'raw',
        		'value' => function($data){
        			return Html::img(($data->dish->photo),[
        				'alt'=>$data->dish->name,
        				'style' => 'width:70px; height:70px; '
        			]);
        		},
        		'contentOptions'=>[ 'style'=>'width: 100px'],
        	],
            'dish.name',
        	'dish.price',
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
