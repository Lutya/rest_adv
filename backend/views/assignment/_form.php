<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\user\User;
use yii\helpers\ArrayHelper;
use backend\models\auth_item\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\models\assignment\Assignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'item_name')->dropDownList(
    		ArrayHelper::map(AuthItem::find()->all(), 'name', 'name'),
    		[
    				'prompt'=>'Select role'
    		]
    		) ?>

    <?//= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'user_id')->dropDownList(
    		ArrayHelper::map(User::find()->all(), 'id', 'username'),
    		[
    				'prompt'=>'Select user'
    		]
    		) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
