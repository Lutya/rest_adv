<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\dish\Dish;

/* @var $this yii\web\View */
/* @var $model frontend\models\order_consist\OrderConsist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-consist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput (['maxlength' => true,
    		'readonly' => true,
    		'value'=> Yii::$app->getRequest()->getQueryParam('order_id')
    ]) ?>

    <?= $form->field($model, 'dish_id')->dropDownList(
    		ArrayHelper::map(Dish::find()->all(), 'id', 'name'),
    		[
    				'prompt'=>'Select dish'
    		]
    		) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Html::encode('Close'), ['orderconsist/close', 'order_id' => Yii::$app->getRequest()->getQueryParam('order_id')], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
