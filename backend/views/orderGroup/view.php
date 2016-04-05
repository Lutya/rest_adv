<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\order_group\OrderGroup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-group-view">

    <h1><?= Html::encode($this->title) ?></h1> 
    
    <?= GridView::widget([
				'dataProvider' => $dishProvider,
				'columns' => [
						[
							'label' => 'Photo',
							'format' => 'raw',
							'value' => function($data){
							return Html::img(($data->dish->photo),[
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
    ?>
</div>
