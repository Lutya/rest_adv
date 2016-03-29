<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\models\order_consist\OrderConsist;
use frontend\models\order_consist\OrderConsistSearch;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\order_consist\OrderConsistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Consists';
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
			'number',
	];
	echo ExportMenu::widget([
			'dataProvider' => $dataProvider,
			'columns' => $gridColumns,
	]);
	?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        		//['class' => 'yii\grid\SerialColumn'],
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
        	'user.username',
        	'orderStatus.name',
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
           
        ],
    ]); ?>

</div>
