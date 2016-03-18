<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\order_status\OrderStatus;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\orders\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
        	[
        		'attribute'=>'user_id',
        		'value'=>'user.username',
        	],
        	[
        		'attribute'=>'order_status_id',
        		'value'=>'orderStatus.name',
        		/*'filter'=>Html::activeDropDownList($searchModel, 'order_status_id',
        					ArrayHelper::map(OrderStatus::find()->asArray()->all(), 'id', 'name'),
        					['class'=>'form-control','prompt' => 'Setect status']),*/
        	],
        	 
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
            'number',
            // 'delivery',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
