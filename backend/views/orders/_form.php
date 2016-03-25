<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\user\User;
use frontend\models\order_status\OrderStatus;

/* @var $this yii\web\View */
/* @var $model frontend\models\orders\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true,
    		'value'=> $order_id,
    		'readonly' => true,
    ]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(
    		ArrayHelper::map(User::find()->all(), 'id', 'username'),
    		[
    				'prompt'=>'Select user name'
    		]
    		) ?>

    <?= $form->field($model, 'order_status_id')->dropDownList(
    		ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'),
    		[
    				'prompt'=>'Select status',
    		]
    		) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
				    'pluginOptions' => [
				        'format' => 'yyyy-mm-dd',
				        'todayHighlight' => true,
				    ]
				]); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
