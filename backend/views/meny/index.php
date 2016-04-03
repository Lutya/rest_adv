
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h1>Menu</h1>
    
<ul>
	<?php foreach ($dish_types as $dish_type): ?>
	    <li>
	        <a href="<?php echo Url::toRoute(['open', 'id' => $dish_type->id]);?>"><?= Html::encode("{$dish_type->name}" )?> </a>
	    </li>
	<?php endforeach; ?>
</ul>
