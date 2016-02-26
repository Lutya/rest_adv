<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\dish_type\DishTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dish Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dish Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


<?php
	$gridColumns = [
			'id',
			'name',
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

            'id',
            'name',
            //'full_name:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
