<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\models\order_group_consist\OrderGroupConsist;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\user_group\UserGroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'User Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $session = Yii::$app->session;
	echo $session->getFlash('acceptEntry');
	echo $session->getFlash('orderConfirm');?>
<div class="user-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php 
    //если пользователь владелец группы показываем кнопки Update, Delete
    if (Yii::$app->user->identity->id == $model->owner_id) {
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
	 
		// если есть новые запросы в группе то отображаем
		if ($userProvider->getCount() > 0) {
			echo yii\grid\GridView::widget([
			        'dataProvider' => $userProvider,
					'columns' => [
							'user.username',
							[
					        	'attribute' => ' Action ',
					        	'value' => function ($data) {
					        		return Html::a(Html::encode(Accept), 
					        				Url::toRoute(['entry/accept', 'group_id' => $data->group_id, 'user_id' => $data->user_id]), 
					        				['class' => 'btn btn-success']). ' '.
					        			Html::a(Html::encode(Reject), 
					        					Url::toRoute(['entry/reject', 'group_id' => $data->group_id, 'user_id' => $data->user_id]), 
					        					['class' => 'btn btn-danger']);
					        		},
					        	'format' => 'raw',
				        	],
						],
					]); 
		}
    }
    //если пользователь не владелец, группу можно покинуть
    else
	    echo Html::a(Html::encode('Leave group'),
	    		Url::toRoute(['entry/reject', 'group_id' => $model->id, 'user_id' => Yii::$app->user->identity->id]),
	    		['class' => 'btn btn-danger']);
   ?>
   <br>
   <br>
   <?php 
	//кнопка фильтра отображения 
	echo Html::a('By users', ['view', 'id' => $model->id, 'filter' => 'users'], ['class' => 'btn btn-primary']); ?>
	<?= Html::a('By dishes', ['view', 'id' => $model->id, 'filter' => 'dishes'], ['class' => 'btn btn-primary']);
	
	// заказ в разрезе пользователей
	if ($filter == 'users') {
		Pjax::begin();
		echo GridView::widget([
	        'dataProvider' => $usersIngroupProvider,
	        'columns' => [
	        		[
	        			'class' => 'kartik\grid\ExpandRowColumn',
	        			'value' => function ($model, $key, $index, $column) {
	        				return GridView::ROW_COLLAPSED;
	        			},
	        			'detail' => function ($model, $key, $index, $column) {
	        				$order_gr_cons = OrderGroupConsist::find()
	        					->where([
	        							'user_id' => $model->user->id,
	        							'order_group.order_status' => false,
	        						])
	        					->joinWith(['orderGroup']);
	        				$dataProvider = new ActiveDataProvider([
	        						'query' => $order_gr_cons
	        				]);
	        					return Yii::$app->controller->renderPartial('_orderitems',[
	        						'dataProvider' => $dataProvider,
	        					]);
	        			
	        				},
	        		],
	        		'user.username',
	        		[
		        		'attribute' => 'Total',
		        		'value' => function ($data) {
		        		$consist = OrderGroupConsist::find()
		        			->where(['user_id' => $data->user->id,
		        					'order_group.order_status' => 0,
		        			])
		        		->joinWith(['orderGroup'])
		        		->all();
		        		$total_summ = 0;
		        		foreach ($consist as $cons) {
		        			$total_summ = $total_summ + $cons->count * $cons->dish->price;
		        			}
		        			return $total_summ;
		        		},
		        		'footer' => 'Всего: '. $total_sum.' грн.',
		        		
	        		],
	       ],
	       'showFooter' => true,
	    ]);
		Pjax::end();
	}
	else
		//заказ в разрезе блюд
		echo GridView::widget([
				'dataProvider' => $dishProvider,
				'columns' => [
						[
								'class' => 'kartik\grid\ExpandRowColumn',
								'value' => function ($model, $key, $index, $column) {
								return GridView::ROW_COLLAPSED;
								},
								'detail' => function ($model, $key, $index, $column) {
								$order_gr_cons = OrderGroupConsist::find()
								->where([
										'dish_id' => $model->dish->id,
										'order_group.order_status' => false,
								])
								->joinWith(['orderGroup']);
								$dataProvider = new ActiveDataProvider([
										'query' => $order_gr_cons
								]);
								return Yii::$app->controller->renderPartial('_ordergroupitems',[
										'dataProvider' => $dataProvider,
								]);
								 
								},
						],
						[
							'label' => 'Photo',
							'format' => 'raw',
							'value' => function($data){
							return Html::img((Yii::getAlias('@imageurl').'/'.$data->dish->photo),[
									'alt'=>$data->dish->name,
									'style' => 'width:70px; height:70px; '
							]);
							},
							'contentOptions'=>[ 'style'=>'width: 100px'],
						],
						'dish.name',
						'dish.price',
						'count',
						[
								'attribute' => 'Total',
								'value' => function ($data) {	 
									return $data->count * $data->dish->price;
								},
								'footer' => 'Всего: '. $total_sum.' грн.',	 
						],
					],
					'showFooter' => true,
		]);
	
	//отображаем владельцу кнопку отправить заказ 
	if (Yii::$app->user->identity->id == $model->owner_id && $order_open == true)
		echo Html::a('Confirm order', ['conf', 'id' => $model->id], ['class' => 'btn btn-success']);
	?>
   	</p>
</div>

