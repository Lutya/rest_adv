<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?php $session = Yii::$app->session;
echo $session->getFlash('editbasket');?>
<h1>Basket</h1>
<div class="dish-index">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],
        	//'id_basket',
        	//'id',
        	'dish.name',
        	'price', 	
        	['attribute' => 'Count',
        	'value' => function ($data) {
        	return Html::a('[-]', Url::toRoute(['basket/edit', 'type' => 'minus', 'id_basket'=>$data->id_basket])).' '.
        			$data->count.' '.
        			Html::a('[+]', Url::toRoute(['basket/edit', 'type' => 'plus', 'id_basket'=>$data->id_basket]));
        	},
        	'format' => 'raw',
        	'footer' => 'Всего:',
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

   if ($dataProvider->getCount() > 0)
   		echo Html::a('Оформить заказ',  Url::toRoute(['order/index']), ['class' => 'btn btn-default']);

?>
