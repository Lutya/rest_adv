<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\models\order_group_consist\OrderGroupConsist;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model frontend\models\user_group\UserGroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'User Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $session = Yii::$app->session;
	echo $session->getFlash('acceptEntry');?>
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
							]
					]); 
		}
    }
    //если пользователь не владелец, группу можно покинуть
    else
	    echo Html::a(Html::encode('Leave group'),
	    		Url::toRoute(['entry/reject', 'group_id' => $model->id, 'user_id' => Yii::$app->user->identity->id]),
	    		['class' => 'btn btn-danger']);
   
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
        							'user_id' => Yii::$app->user->identity->id,
        				]);
        				$dataProvider = new ActiveDataProvider([
        						'query' => $order_gr_cons
        				]);
        					return Yii::$app->controller->renderPartial('_orderitems',[
        						'dataProvider' => $dataProvider,
        					]);
        			
        				}
        		],
        		'user.username',
       ],
    ]);
	    
	?>
   	</p>
</div>
