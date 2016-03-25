<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\models\order_consist\OrderConsist;
use frontend\models\order_consist\OrderConsistSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\order_consist\OrderConsistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Consists';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],
        	'order.user.username',
        	'order.orderStatus.name',
            'dish.name',
        	'dish.price',
            'count',
        ],
    ]); ?>

</div>
