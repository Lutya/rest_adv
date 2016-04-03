<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use frontend\models\entry\Entry;
?>

<?php 
	$new_user_count = Entry::find()
		->where(['group_id' => $model->id,
				'status_user' => False,
				])
		->count();
	if ($new_user_count > 0) 
		$new_user_count = ' (+'.$new_user_count.')';
	else 
		$new_user_count = '';
?>
<div class="post">  
    <?//= HtmlPurifier::process($model->name).$new_user_count ?>   
    
    <?= Html::a(Html::encode(($model->name).$new_user_count), Url::toRoute(['group/view', 'id'=> $model->id,])); ?> 
</div>