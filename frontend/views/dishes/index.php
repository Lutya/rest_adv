<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
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
        		return (Html::input('text', $data->id, '', ['class' => 'input-count']));
        			
        		},
        		'format' => 'raw',
        		],
        		
        	[
		        'attribute' => ' Basket ',
		        'value' => function ($data) {
		            return Html::a(Html::encode(Добавить), Url::toRoute(['basket/create', 'dish_id'=>$data->id,
		            																      'count' => 1,//нужно сделать форму для ввода количества
		            																	  ]));
		            
		        },
		        'format' => 'raw',
		    ],
        ],
    ]); ?>
    
    
    <?php $form = ActiveForm::begin([
    'id' => 'count-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <?= $form->field($model, 'count') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('В корзину', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
</div>
