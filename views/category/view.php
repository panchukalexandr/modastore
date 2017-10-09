<?php
/* @var $this yii\web\View */
//$this->title = 'Товары категории';
use app\components\helper\PriceHelper;
use yii\helpers\Html;
?>

<!--<section id="advertisement">-->
<!--    <div class="container">-->
<!--        <img src="/images/shop/advertisement.jpg" alt="" />-->
<!--    </div>-->
<!--</section>-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Меню категорий</h2>
                    <div class="nestedsidemenu">
                        <ul>
                            <?= \app\components\NewMenuWidget::widget(['tpl' => 'new_menu']) ?>
                        </ul>
                    </div>
                    <!--/category-products-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?=$category['name']?></h2>

                    <?php if (!empty($products)): ?>
                        <?php $i = 0; foreach ($products as $product): ?>
                        <?php $mainImg = $product->getImage(); ?>

                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                            <a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $product->id])?>">
                                                <?=Html::img($mainImg->getUrl(), ['alt' => $product['name']])?>
                                            </a>
                                        <?php if ($product->price): ?>
                                            <span class="price"><?= PriceHelper::from($product->price)?></span>
                                        <?php endif; ?>
                                        <p><a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $product->id])?>"><?=$product->name?></a>

                                        </p>
                                        <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$product->id])?>" data-id="<?=$product->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                    </div>
                                </div>
                                <?php if ($product->new): ?>
                                    <?=Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class'=>'newarrival'])?>
                                <?php endif;?>

                                <?php if ($product->sale): ?>
                                    <?=Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class'=>'newarrival'])?>
                                <?php endif;?>


                                <!--                            <div class="choose">-->
    <!--                                <ul class="nav nav-pills nav-justified">-->
    <!--                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>-->
    <!--                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>-->
    <!--                                </ul>-->
    <!--                            </div>-->
                            </div>
                        </div>

                        <?php $i++; ?>
                        <?php if ($i % 3 == 0): ?>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                        <?php  endforeach; ?>
                    <?php else: ?>
                        <h2>По данной категории товаров пока нет ...</h2>
                    <?php endif; ?>
                </div><!--features_items-->

                <div class="clearfix"></div>
                <?=
                    \yii\widgets\LinkPager::widget([
                            'pagination' => $pages
                    ])

                ?>

            </div>
        </div>
    </div>
</section>