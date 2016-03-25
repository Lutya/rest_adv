<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\models\order_consist\OrderConsist;
use frontend\models\order_consist\OrderConsistSearch;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\order_consist\OrderConsistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Consists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-consist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
        	/*[
        		'attribute'=>'order_id',
        		'value'=>'order.date',
        	],*/
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
				    //'name' => 'check_issue_date', 
				    'value' => date('Y-m-d'),
				    'options' => ['placeholder' => 'Select date'],
				    'pluginOptions' => [
				        'format' => 'yyyy-mm-dd',
				        'todayHighlight' => true
				    ]
				]),
        	],
        	/*'order.user.username',
        	'order.orderStatus.name',
            'dish.name',
        	'dish.price',*/
            'number',
        ],
    ]); ?>

</div>
