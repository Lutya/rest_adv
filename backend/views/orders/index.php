<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\order_status\OrderStatus;
use kartik\date\DatePicker;
use kartik\grid\GridView;
use frontend\models\order_consist\OrderConsistSearch;
use frontend\models\order_consist\OrderConsist;
use kartik\export\ExportMenu;
//use backend\models\user\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\orders\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-consist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php
	$gridColumns = [
			'id',
        	'user.username',
        	'orderStatus.name',
			'date',
			'number',
	];
	echo ExportMenu::widget([
			'dataProvider' => $dataProvider,
			'columns' => $gridColumns,
	]);
	?>
	
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Orders', ['create', 'order_id' => uniqid('OR')], ['class' => 'btn btn-success']);?> <br><br>
        <?= Html::a(Html::encode('Открытые'), ['orders/statusfilter', 'status_id'=> 1], ['class' => 'btn btn-primary']);?>
 		<?= Html::a(Html::encode('Закрытые'), ['orders/statusfilter', 'status_id'=> 3], ['class' => 'btn btn-primary']);?>
		<?= Html::a(Html::encode('В обработке'), ['orders/statusfilter', 'status_id'=> 2], ['class' => 'btn btn-primary']);?>
		<?= Html::a(Html::encode('Все'), ['orders/index'], ['class' => 'btn btn-primary']);?>
		<?= Html::a(Html::encode('Отчет'), ['orderconsist/index'], ['class' => 'btn btn-danger']);?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        		[
        			'class' => 'kartik\grid\ExpandRowColumn',
        			'value' => function ($model, $key, $index, $column) {
        				return GridView::ROW_COLLAPSED;
        			},
        			'detail' => function ($model, $key, $index, $column) {
        			$searchModel = new OrderConsistSearch();
        			$searchModel->order_id = $model->id;
        			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        				return Yii::$app->controller->renderPartial('_orderitems',[
        					'searchModel' => $searchModel,
        					'dataProvider' => $dataProvider,
        					]);
        			
        				}
        		],
        		'id',
        		[
        			'attribute'=>'user_id',
        			'value'=>'user.username',
        		],
        		[
        			'attribute'=>'orderStatus.name',
        			'value'=>'orderStatus.name',
        			'contentOptions'=>['style'=>'width: 100px;',
            				'class' => 'text-center'
            		],
				],
        		[
        				'attribute'=>'date',
        				'value'=>'date',
        				'headerOptions' => ['width' => '200'],
        				'format'=>'raw',
        				'filter'=>DatePicker::widget([
        						'model'=>$searchModel,
        						'attribute'=>'date',
        						'value' => date('Y-m-d'),
        						'options' => ['placeholder' => 'Select date'],
        						'pluginOptions' => [
        								'format' => 'yyyy-mm-dd',
        								'todayHighlight' => true
        						]
        				]),
        		],
        		'number',
        		[
        				'attribute' => 'Total',
        				'value' => function ($data) {
        					$consist = OrderConsist::findAll(['order_id' => $data->id]);
        					$total_sum = 0;
        					foreach ($consist as $cons) {
        						$total_sum = $total_sum + $cons->count * $cons->dish->price;
        						}
        					return $total_sum;
        				}
        		],
            ['class' => 'yii\grid\ActionColumn',
            	'template' => '{view}{delete}',
            	'contentOptions'=>['style'=>'width: 60px;',
            				'class' => 'text-center'
            	],
    		],
       ],
    ]); ?>

</div>
