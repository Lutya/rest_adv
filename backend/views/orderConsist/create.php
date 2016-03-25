<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\order_consist\OrderConsist */

$this->title = 'Create Order Consist';
$this->params['breadcrumbs'][] = ['label' => 'Order Consists', 'url' => ['orders/view', 'id' => Yii::$app->getRequest()->getQueryParam('order_id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-consist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
