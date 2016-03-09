<?php
$cookies_req = Yii::$app->request->cookies;
$cookies_resp = Yii::$app->response->cookies;
$id_bask =  $cookies_req->get('id_bask');
if (!isset($id_bask)){
	$uniq_id = uniqid('ID');
	$cookies_resp->add(new \yii\web\Cookie([
			'name' => 'id_bask',
			'value' => $uniq_id,
			'expire' => time()+60*60*24*24,
	]));
	 
}
else
	$cookies_resp->add(new \yii\web\Cookie([
			'name' => 'id_bask',
			'value' => $id_bask,
			'expire' => time()+60*60*24*24,
	]));

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php 	
    $session = Yii::$app->session;
    NavBar::begin([
        'brandLabel' => 'Restaurant',
        'brandUrl' => Yii::$app->homeUrl, 
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => $cookies_req->get('id_bask'), 'url' => ['/site/about']],
    	//['label' => $session['user_id'], 'url' => ['/site/about']],
    		
        //['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    //$cookies_resp->remove('id_bask');
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    $menuItems[] = ['label' => 'Basket'.' ('.$session['totalsum'].' грн.)', 'url' => ['/basket/index']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
