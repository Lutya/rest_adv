<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ListView;
use kartik\date\DatePicker;
use frontend\models\user_group\UserGroup;
use frontend\models\entry\Entry;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\user_group\UserGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $session = Yii::$app->session;
	echo $session->getFlash('addEntry');?>
<div class="user-group-index">

    <h1><?//= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p><b>Groups, created you:</b></p>
	<?= ListView::widget([
    		'dataProvider' => $ownerProvider,
    		//'itemView' => '_post',
			'itemView' => function ($model, $key, $index, $widget) {
				return $this->render('_list_owner',['model' => $model]);
			},
		]);
	?>
	
	<p><b>Groups:</b></p>
	<?= ListView::widget([
    		'dataProvider' => $entryProvider,
    		//'itemView' => '_post',
			'itemView' => function ($model, $key, $index, $widget) {
				return $this->render('_list_entry',['model' => $model]);
			},
		]);
	?>
	
	
	
	
    <p>
        <?= Html::a('Create User Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
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
        	[
        		'attribute' => 'owner',
 				'value' => 'owner.username',
            ],
        	[
        		'label' => 'Count users',
        		'format' => 'raw',
        		'value' => function($data){
        			$count = Entry::find()
        				->where(['group_id' => $data->id,
        						'status_user' => True,
        			])
        				->count();
        			return $count;
        		},
        	],
        	[
	        	'attribute' => ' Entry ',
	        	'value' => function ($data) {
	        		return Html::a(Html::encode(Вступить), Url::toRoute(['entry/add', 'group_id' => $data->id]));
	        		},
	        	'format' => 'raw',
        	],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
