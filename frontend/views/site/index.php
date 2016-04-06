<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Restaurant';
?>
<div class="site-index">

    <!-- <div class="jumbotron">
        <h1>Menu</h1>

        <p class="lead">Chek menu</p>

         <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> 
    </div>  -->

    <div class="body-content">
	<?php// var_dump($dish_types); ?>

        <div class="row">
            <div class="col-lg-4"> 
               <!-- <h2>Salats</h2>  --> 
				<?php //echo($dish_types[0]['name']); ?>
                <p><a class="btn btn-default"  href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[0]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/salat.jpg', 
                			[
        						'style' => 'width:300px; height:250px; '
        					]); ?>
                		
                		<br>Салаты &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <!-- <h2>Zakuski</h2> -->

                <?php //echo($dish_types[1]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[1]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/zakuski.jpg', 
                			[
        						'style' => 'width:300px; height:250px; '
        					]); ?>
                		
                		<br>Закуски &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <!-- <h2>Первые блюда</h2> -->

                <?php //echo($dish_types[2]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[2]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/pervoe.jpg', 
                			[
        						'style' => 'width:300px; height:250px; '
        					]); ?>
                		
                		<br>Первое &raquo;</a></p>
            </div>
            
            <div class="col-lg-4">
                <!-- <h2>Основное</h2> -->

                <?php //echo($dish_types[3]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[3]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/osnovnoe.jpg', 
                			[
        						'style' => 'width:300px; height:250px; '
        					]); ?>
                		
                		<br>Основные блюда &raquo;</a></p>
            </div>
            
            <div class="col-lg-4">
                <!-- <h2>Паста</h2> -->

                <?php //echo($dish_types[4]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[4]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/pasta.jpg', 
                			[
        						'style' => 'width:300px; height:250px; '
        					]); ?>
                		
                		<br>Паста &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <!-- <h2>Напитки</h2> -->

                <?php //echo($dish_types[5]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[5]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/napitki.jpg', 
                			[
        						'style' => 'width:300px; height:250px; '
        					]); ?>
                		
                		<br>Напитки &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <!-- <h2>Гарниры</h2> -->

                <?php //echo($dish_types[6]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[6]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/garnir.jpg', 
                			[
        						'style' => 'width:300px; height:300px; '
        					]); ?>
                		
                		<br>Гарниры &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <!-- <h2>Десерты</h2> -->

                <?php //echo($dish_types[7]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[7]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/desert.jpg', 
                			[
        						'style' => 'width:300px; height:300px; '
        					]); ?>
                		
                		<br>Десерты &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <!-- <h2>Фирмовые блюда</h2> -->

                <?php //echo($dish_types[8]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[8]['id']]); ?>">
                		<?php echo Html::img(Yii::getAlias('@imageurl').'/uploads/menu/firm.jpg', 
                			[
        						'style' => 'width:300px; height:300px; '
        					]); ?>
                		
                		<br>Фирмовые блюда &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
