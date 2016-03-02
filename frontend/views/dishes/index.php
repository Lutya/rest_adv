<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?php// var_dump ($dishes); ?>

<ul>
	<?php foreach ($dishes as $dish): ?>
	    <li>
	        <?= Html::encode("{$dish['name']} - {$dish['price']} грн. - {$dish['count']} {$dish['measure_name']}" )?>
	    </li>
	<?php endforeach; ?>
</ul>

<div class="dish-index">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
        	'note:ntext',
            //'dishType.name',
            'count',
            'measure.name',
            'price',
        		[
        		'attribute' => 'View',
        		'value' => function ($data) { //Url::toRoute(['/date-time/fast-forward', 'id' => 105]);
        		return (Html::input('text', 'username', $user->name, ['class' => $username]));
        			
        		},
        		'format' => 'raw',
        		],
        		
        	[
		        'attribute' => 'View',
		        'value' => function ($data) { //Url::toRoute(['/date-time/fast-forward', 'id' => 105]);
		            return Html::a(Html::encode(view), Url::toRoute(['dish/view', 'id' => $data->name]));
		            
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
