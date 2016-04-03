<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
?>
<div class="post">  
    <?//= HtmlPurifier::process($model->group->name)?>
    <?= Html::a(Html::encode(($model->group->name)), Url::toRoute(['group/view', 'id'=> $model->group->id,])); ?>    
</div>