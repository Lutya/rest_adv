<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Restaurant';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Menu</h1>

        <p class="lead">Chek menu</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
	<?php// var_dump($dish_types); ?>

        <div class="row">
            <div class="col-lg-4">
                <h2>Salats</h2>
				<?php echo($dish_types[0]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[0]['id']]); ?>">Салаты &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Zakuski</h2>

                <?php echo($dish_types[1]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[1]['id']]); ?>">Закуски &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Первые блюда</h2>

                <?php echo($dish_types[2]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[2]['id']]); ?>">Первое &raquo;</a></p>
            </div>
            
            <div class="col-lg-4">
                <h2>Основное</h2>

                <?php echo($dish_types[3]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[3]['id']]); ?>">Основные блюда &raquo;</a></p>
            </div>
            
            <div class="col-lg-4">
                <h2>Паста</h2>

                <?php echo($dish_types[4]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[4]['id']]); ?>">Паста &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Напитки</h2>

                <?php echo($dish_types[5]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[5]['id']]); ?>">Напитки &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Гарниры</h2>

                <?php echo($dish_types[6]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[6]['id']]); ?>">Гарниры &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Десерты</h2>

                <?php echo($dish_types[7]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[7]['id']]); ?>">Десерты &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Фирмовые блюда</h2>

                <?php echo($dish_types[8]['name']); ?>
                <p><a class="btn btn-default" href=" <?php echo Url::toRoute(
                		['dishes/index', 'dish_type_id' => $dish_types[8]['id']]); ?>">Фирмовые блюда &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
