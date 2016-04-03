<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use frontend\models\entry\Entry;
?>
<h1>Order</h1>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        	['class' => 'yii\grid\SerialColumn'],
        	'dish.name',
        	'price',
        	'count',
        	['attribute' => 'Summ',
        		'value' => function ($data) {
        			return $data->price * $data->count;// * $data['dish.price']; 

        		},
        	'footer' => 'Всего: ' . $total_sum. ' грн.',
        	'format' => 'raw',
        	],
        	['class' => 'yii\grid\ActionColumn',
        		'template' => '{delete}',
        	],
        ],
        'showFooter' => true,
    ]); 

    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number') ?>
    <?php 
    $user_id = Yii::$app->user->identity->id;
    $groups = Entry::find()
    	->where([
    			'user_id' => $user_id,
    			'status_user' => true,
    	])
    	->all(); 
    $items = ArrayHelper::map($groups, 'group.id', 'group.name');
    $params = [
    		'prompt' => 'Select group'
    ]; 
    echo $form->field($model, 'group')->dropDownList($items, $params)?>
    <?//= $form->field($model, 'group') ?>
	
	<?php if ($dataProvider->getCount() > 0) 
        	echo Html::submitButton('Отправить', ['class' => 'btn btn-primary']);
		 else 
    		echo ('Невозможно отправить пустой заказ!'); ?>

<?php ActiveForm::end();
        		
   //echo Html::a('Отправить заказ', Url::toRoute(['order/send']));
?>