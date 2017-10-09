<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta name="description" content="">
    <meta name="author" content="">
     <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php 
    	$this->registerJsFile('/web/js/html5shiv.js', [
    		'position'  => Yii\web\View::POS_HEAD,
    		'condition' => 'lte IE9'
    	]);
    	$this->registerJsFile('/web/js/respond.min.js', [
    		'position'  => Yii\web\View::POS_HEAD,
    		'condition' => 'lte IE9'
    	]);
    ?>

    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/web/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/web/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/web/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/web/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<?php $this->beginBody() ?>

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:+380633148962"><i class="fa fa-phone"></i> 063-314-89-62</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> imoda-store@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
<!--								<li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
<!--								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
<!--								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>-->
<!--								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?= Url::home()?>"><img src="/web/images/home/logo2_1.png" alt="" /></a>
						</div>

					</div>

                    <div class="col-sm-5">
                        <div class="header-info">
                            <p>График работы: ПН-СБ 9:30-19:00</p>
                            <p style="color: red">Бесплатная доставка на склад Новой Почты при заказе от 800 грн</p>
                        </div>
                    </div>

					<div class="col-sm-3">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">

                                <?php if (!Yii::$app->user->isGuest): ?>
								    <li><a href="<?= Url::to(['/admin'])?>"><i class="fa fa-user"></i> Админ панель </a></li>
                                <?php endif; ?>

<!--								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>-->
<!--								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>-->
								<?php
                                $session = Yii::$app->session;
                                $session->open();
                                ?>

                                <li><a href="#" onclick="return getCart()">
                                        <i class="fa fa-shopping-cart"></i>
                                        Корзина (<span class="count"><?=$session['cart.qty'] != 0 ? $session['cart.qty'] : 0 ?></span>)
                                    </a>
                                </li>
<!--								<li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

        <div class="header-bottom">
            <div class="container">
                <div id='cssmenu'>
                    <ul>
                        <?=\app\components\MenuWidgetN::widget(['tpl' => 'menun'])?>
                    </ul>
                </div>

                <div class="searchformset">
                    <div class="single-widget">
                        <div class="searchform">
                            <form method="get" action="<?= Url::to(['category/search'])?>">
                                <input type="text" placeholder="Поиск" name="queryUser" >
                            </form>
                        </div>
                    </div>
                </div>
                <div id="breadcrumbs">
                    <?= Breadcrumbs::widget([
//                        'tag' => 'ul',
                        'homeLink' => ['label' => 'Главная', 'url' => '/'],
                        'itemTemplate' => "<li class=\"breadcrumbs-item\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><i>{link}</i></li>",
                        'links' => (isset($this->params['breadcrumbs'])) ? $this->params['breadcrumbs'] : []
                    ]) ?>
                </div>
            </div>

        </div>
	</header>
<!--/header-->


<?= $content; ?>

	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
<!--					<div class="col-sm-2">-->
<!--						<div class="companyinfo">-->
<!--							<h2><span>e</span>-shopper</h2>-->
<!--							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>-->
<!--						</div>-->
<!--					</div>-->
<!--				<div class="col-sm-7"></div>-->
<!--					<div class="col-sm-3">-->
<!--						<div class="address">-->
<!--							<img src="/web/images/home/map.png" alt="" />-->
<!--							<p></p>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
                    <div class="col-sm-3">
                        <div class="companyinfo">
                            <h2><span>i</span>moda-store</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Информация</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="<?=Url::to(['/contact'])?>">Контакты</a></li>
								<li><a href="<?=Url::to(['/about'])?>">О нас</a></li>
								<li><a href="<?=Url::to(['/delivery'])?>">Оплата и доставка</a></li>
								<li><a href="<?=Url::to(['/order'])?>">Как оформить заказ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Поиск по сайту</h2>
                            <div class="  searchform">
                                <form method="get" action="<?= Url::to(['category/search'])?>">
                                    <input type="text" placeholder="Поиск" name="queryUser" >
                                </form>
                            </div>
						</div>
					</div>

                    <div class="col-sm-3">
                        <div class="address">
                            <img src="/web/images/home/map.png" alt="" />
                            <p></p>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</footer>
<!--/Footer-->

<?php
$cartView = Url::to(['cart/view']);
Modal::begin([
    'header' => '<h2>Корзина</h2> ',
    'id' => 'cart',
    'size' => 'modal-lg',
    'footer' => '
        <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупку</button>
        <a href=" '.$cartView.' " class="btn btn-success">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>
        '
]);

Modal::end();
?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>