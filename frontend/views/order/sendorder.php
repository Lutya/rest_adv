<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>
<h1>Order was send</h1>
<?php $session = Yii::$app->session;
   	$session['totalsum'] = 0; ?>
<?= $message ?>