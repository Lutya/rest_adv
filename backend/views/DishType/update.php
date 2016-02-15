<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\dish_type\DishType */

$this->title = 'Update Dish Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dish Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dish-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
