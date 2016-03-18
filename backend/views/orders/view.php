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
    Date: <?= $model->date; ?></h3>
 	<?= GridView::widget([
        'dataProvider' => $dataProvider,
 		'columns' => [
 				['class' => 'yii\grid\SerialColumn'],
 				'dish.name',
 				'dish.price',
 				[
 					'attribute' => 'Minus',
 					'value' => function ($data) {
 						return Html::a('[-]', Url::toRoute(['orders/update', 'type' => 'minus', 'id_order'=>$data->order_id,
 								'id_dish'=>$data->dish_id
 						]));
 						},
 					'format' => 'raw',
 				],
 				'count',
 				[
 					'attribute' => 'Plus',
 					'value' => function ($data) {
 						return Html::a('[+]', Url::toRoute(['orders/update', 'type' => 'plus', 'id_order'=>$data->order_id,
 								'id_dish'=>$data->dish_id,
 						]));
 						},
 					'footer' => 'Всего:',
 					'format' => 'raw',
 				],
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
 				'id',
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

</div>
