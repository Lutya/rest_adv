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
        	//'id_basket',
        	//'id',
        	'dish.name',
        	'price',
        	'count',
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
        		'footer' => 'Всего:',
        		'format' => 'raw',
        	],
        	['attribute' => 'Summ',
        		'value' => function ($data) {
        			return $data->price * $data->count;// * $data['dish.price']; 

        		},
        	'footer' => $total_sum,
        	'format' => 'raw',
        	],
        	['class' => 'yii\grid\ActionColumn',
        		'template' => '{delete}',
        	],
        ],
        
        //'showPageSummary' => true,
        'showFooter' => true,
    ]); 
        		
   echo Html::a('Оформить заказ', Url::toRoute(['order/index']));
?>
