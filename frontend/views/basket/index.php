<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?php $session = Yii::$app->session;
echo $session->getFlash('editbasket');?>
<h1>basket/index</h1>
<div class="dish-index">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],
        		'id_basket',
        		'id',
        	'dish.name',
        	'dish.price',
        	['attribute' => 'Minus',
        		'value' => function ($data) {
        			return Html::a('[-]', Url::toRoute(['basket/edit', 'type' => 'minus', 'id_basket'=>$data->id_basket]));
        					},
        			'format' => 'raw',
        	],
        	['attribute' => 'Count',
        		'value' => function ($data) {
        			return $data->count; 
        		},
        		'format' => 'raw',
        	],
        	['attribute' => 'Plus',
        		'value' => function ($data) {
        			return Html::a('[+]', Url::toRoute(['basket/edit', 'type' => 'plus', 'id_basket'=>$data->id_basket]));
        					},
        			'format' => 'raw',
        	],
        	['class' => 'yii\grid\ActionColumn',
        		'template' => '{delete}',
        	],
        ],
        'showFooter' => true,
    ]); ?>
