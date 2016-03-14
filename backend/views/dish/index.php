<?php

use yii\helpers\Html;
use yii\helpers\Url	;
//use yii\grid\GridView;
use backend\models\dish_type\DishType;
use backend\models\dish\Dish;
use backend\models\measure\Measure;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\dish\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dishes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
	$gridColumns = [
			//'id',
			'name',
			'dishType.name',
			'count',
			'measure.name',
			'price',
			'note',
	];
	echo ExportMenu::widget([
			'dataProvider' => $dataProvider,
			'columns' => $gridColumns,
	]);
?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            #'id',
        	//'photo:image',
        	[
	        	'label' => 'Photo',
	        	'format' => 'raw',
	        	'value' => function($data){
	        	return Html::img(($data->photo),[
	        				'alt'=>$data->name,
	        				'style' => 'width:150px; height:150px; '
	        	]);
	        	},
        	],
            'name',
        	'dishType.name',
            'count',
            'measure.name',
            'price',

            [
            	'class' => 'yii\grid\ActionColumn',
             	'headerOptions' => ['width' => '80'],
	        ],
        ],
    ]); ?>

</div>
