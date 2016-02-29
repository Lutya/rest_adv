<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php// var_dump ($dishes); ?>

<ul>
	<?php foreach ($dishes as $dish): ?>
	    <li>
	        <?= Html::encode("{$dish['name']} - {$dish['price']} грн. - {$dish['count']} {$dish['measure_name']}" )?>
	    </li>
	<?php endforeach; ?>
</ul>
