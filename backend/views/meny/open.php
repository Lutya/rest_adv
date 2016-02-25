
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<div class="dish-index">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'dishType.name',
            'count',
            'measure.name',
            'price',
            'note:ntext',
        	[
		        'attribute' => 'View',
		        'value' => function ($data) { //Url::toRoute(['/date-time/fast-forward', 'id' => 105]);
		            return Html::a(Html::encode(view), Url::toRoute(['dish/view', 'id' => $data->id]));
		            
		        },
		        'format' => 'raw',
		    ],
		    
		    [
		    'attribute' => 'Edit',
		    'value' => function ($data) { //Url::toRoute(['/date-time/fast-forward', 'id' => 105]);
		    return Html::a(Html::encode(edit), Url::toRoute(['dish/update', 'id' => $data->id]));
		    
		    },
		    'format' => 'raw',
		    ],
		    
		    /*[
		    'attribute' => 'Delete',
		    'value' => function ($data) { //Url::toRoute(['/date-time/fast-forward', 'id' => 105]);
		    return Html::a(Html::encode(delete), Url::toRoute(['dish/delete', 'id' => $data->id]));
		    
		    },
		    'format' => 'raw',
		    ],*/
        ],
    ]); ?>
</div>