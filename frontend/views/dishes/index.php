<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>
<?php $session = Yii::$app->session;
echo $session->getFlash('updatebasket');?>
<div class="dish-index">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
        	'note:ntext',
            'count',
            'measure.name',
            'price',  		
        	[
		        'attribute' => ' Basket ',
		        'value' => function ($data) {
		            return Html::a(Html::encode(Добавить), Url::toRoute(['basket/create', 'dish_id'=> $data->id,]));   
		        },
		        'format' => 'raw',
		    ],
        ],
    ]); ?>
</div>
