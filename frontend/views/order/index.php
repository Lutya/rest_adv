<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>
<h1>order/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
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

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end();
        		
   //echo Html::a('Отправить заказ', Url::toRoute(['order/send']));
?>