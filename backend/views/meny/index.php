
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h1>meny/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
    
<ul>
	<?php foreach ($dish_types as $dish_type): ?>
	    <li>
	        <a href="<?php echo Url::toRoute(['open', 'id' => $dish_type->id]);?>"><?= Html::encode("{$dish_type->name} - {$dish_type->id}" )?> </a>
	    </li>
	<?php endforeach; ?>
</ul>
</p>
