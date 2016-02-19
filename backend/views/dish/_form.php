<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\dish_type\DishType;
use backend\models\measure\Measure;

/* @var $this yii\web\View */
/* @var $model backend\models\dish\Dish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'dish_type_id')->dropDownList(
    		ArrayHelper::map(DishType::find()->all(), 'id', 'name'),
    		[
    				'prompt'=>'Select dish type'
    		]
    		) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'measure_id')->textInput() ?>
    
     <?= $form->field($model, 'measure_id')->dropDownList(
    		ArrayHelper::map(Measure::find()->all(), 'id', 'name'),
    		[
    				'prompt'=>'Select measure'
    		]
    		) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
