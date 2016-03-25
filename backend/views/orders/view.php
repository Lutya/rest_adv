<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\orders\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $session = Yii::$app->session;
echo $session->getFlash('updateOrder');?>
<div class="orders-view">

    <h3> User: <?= Html::encode($model->user->username) ?> <br>
    Date: <?= $model->date; ?> <br>
    Status: <?= $model->orderStatus->name; ?></h3>
 	<?= GridView::widget([
        'dataProvider' => $dataProvider,
 		'columns' => [
 				['class' => 'yii\grid\SerialColumn'],
 				[
	 				'label' => 'Photo',
	 				'format' => 'raw',
 					'contentOptions'=>['style'=>'width: 170px;'],
	 				'value' => function($data){
	 					return Html::img(($data->dish->photo),[
	 							'alt'=>$data->dish->name,
	 							'style' => 'width:150px; height:150px; '
	 					]);
	 				},
 				],
 				'dish.name',
 				'dish.price',
 				[
 					'attribute' => 'Count',
 					'contentOptions'=>['style'=>'width: 100px;',
 							'class' => 'text-center'
 					],
 					'value' => function ($data) {
 						return Html::a('[-]', Url::toRoute(['orders/update', 'type' => 'minus', 'id_order'=>$data->order_id,
 								'id_dish'=>$data->dish_id
 						])).' '.$data->count.' '.
 						 Html::a('[+]', Url::toRoute(['orders/update', 'type' => 'plus', 'id_order'=>$data->order_id,
 								'id_dish'=>$data->dish_id,
 						]));
 						},
 					'format' => 'raw',
 				],
 				/*'count',
 				[
 					'attribute' => 'Plus',
 					'contentOptions'=>['style'=>'width: 50px;',
 								'class' => 'text-center'
 					],
 					'value' => function ($data) {
 						return Html::a('[+]', Url::toRoute(['orders/update', 'type' => 'plus', 'id_order'=>$data->order_id,
 								'id_dish'=>$data->dish_id,
 						]));
 						},
 					'footer' => 'Всего:',
 					'format' => 'raw',
 				],*/
 				[
 					'attribute' => 'Summ',
 					'value' => function ($data) {
 						return  $data->dish->price * $data->count;
 						},
 					'footer' => $total_sum,
 					'format' => 'raw',
 				],
 				/*[
 					'class' => 'yii\grid\ActionColumn',
 					'controller' => 'orders',
 					'template' => '{delete}',
 				],*/
 				//'id',
 				[
 					'attribute' => ' Delete ',
 					'value' => function ($data) {
 						return Html::a(Html::encode(Delete), Url::toRoute(['orders/delconsist', 'id'=> $data->id,]));
 						},
 					'format' => 'raw',
 				],
 			],
 		'showFooter' => true,
 	]); ?>
 	
 	<?php if ($model->order_status_id == 1) {
 	 	echo Html::a(Html::encode('В обработку'), ['orders/alterstatus', 'order_id' => $model->id, 'status'=> 'work'], ['class' => 'btn btn-success']);
 	 	echo Html::a(Html::encode('Закрыть'), ['orders/alterstatus', 'order_id' => $model->id, 'status'=> 'close'], ['class' => 'btn btn-primary']);
 	} elseif ($model->order_status_id == 2) {
 		echo Html::a(Html::encode('Открыть'), ['orders/alterstatus', 'order_id' => $model->id, 'status'=> 'open'], ['class' => 'btn btn-danger']);
 		echo Html::a(Html::encode('Закрыть'), ['orders/alterstatus', 'order_id' => $model->id, 'status'=> 'close'], ['class' => 'btn btn-primary']);
 	} else {
 		echo Html::a(Html::encode('В обработку'), ['orders/alterstatus', 'order_id' => $model->id, 'status'=> 'work'], ['class' => 'btn btn-success']);
 		echo Html::a(Html::encode('Открыть'), ['orders/alterstatus', 'order_id' => $model->id, 'status'=> 'open'], ['class' => 'btn btn-danger']);
 	}
?>
</div>
