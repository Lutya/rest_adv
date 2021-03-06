<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\orders\Orders */

$this->title = 'Create Orders';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <?= $this->render('_form', [
        'model' => $model,
    	'order_id' => $order_id,
    ]) ?>

</div>
