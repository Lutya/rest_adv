<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\order_group\OrderGroupSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'group.name',
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

            ['class' => 'yii\grid\ActionColumn',
            	'template' => '{view}',
            	'contentOptions'=>['style'=>'width: 60px;',
            				'class' => 'text-center'
            	],
    		],
        ],
    ]); ?>

</div>
