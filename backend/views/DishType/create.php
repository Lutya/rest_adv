<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\dish_type\DishType */

$this->title = 'Create Dish Type';
$this->params['breadcrumbs'][] = ['label' => 'Dish Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
