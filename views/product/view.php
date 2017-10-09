<?php
/* @var $this yii\web\View */
use app\components\helper\PriceHelper;
use yii\helpers\Html;
?>
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
                </div>
            </div>

            <?php
                $mainImg = $product->getImage();
                $gallery = $product->getImages();
//                debug($mainImg->getUrl());
            ?>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">

                        <div class="view-product">
                            <?=Html::img($mainImg->getUrl())?>
<!--                            <h3>ZOOM</h3>-->
                        </div>

                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner  ">
                                <?php $count = count($gallery); $i = 0; foreach ($gallery as $img): ?>
                                    <?php if ($i % 3 == 0): ?>
                                        <div class="item <?php if ($i == 0) echo 'active'?>">
                                    <?php endif;  ?>
                                    <a href="<?=\yii\helpers\Url::to($img->getUrl())?>"
                                       class='lightview'
                                       data-lightview-group='example'>
                                        <?=Html::img($img->getUrl('84*85'), ['alt' => ''])?></a>

                                    <?php $i++; if ($i % 3 == 0 || $i==$count): ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->

                            <?php if ($product->new): ?>
                                <?=Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class'=>'newarrival'])?>
                            <?php endif;?>

                            <?php if ($product->sale): ?>
                                <?=Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class'=>'newarrival'])?>
                            <?php endif;?>

                            <h2><?=$product->name?></h2>
<!--                            <p>Web ID: 1089772</p>-->
<!--                            <img src="/web/images/product-details/rating.png" alt="" />-->
                            <span>
									<span><?=PriceHelper::from($product->price)?></span>
									<div class="clearfix"></div>
                                    <label>Количество:</label>
									<input type="text" value="1" id="qty" />
									<a href="<?=\yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" class="btn btn-fefault cart add-to-cart" data-id="<?=$product->id?>">
										<i class="fa fa-shopping-cart"></i>
										Добавить в корзину
									</a>
								</span>
                            <p><b>В наличии: </b> Есть в наличии</p>

                            <?php if ($product->size): ?>
                                <p><b>Размер: </b><?=$product->size?></p>
                            <?php endif; ?>

                            <p><b>Категория: </b><a href="<?=\yii\helpers\Url::to(['category/view', 'id'=>$product->category->id])?>"><?=$product->category->name?></p></a>
<!--                            <a href=""><img src="/web/images/product-details/share.png" class="share img-responsive"  alt="" /></a>-->
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Информация о товаре</a></li>
                            <li class="active"><a href="#companyprofile" data-toggle="tab">Похожие товары с категории</a></li>
                            <li><a href="#sizes" data-toggle="tab">Таблица размеров</a></li>
                            <li><a href="#reviews" data-toggle="tab">Отзывы </a></li>
                            <li><a href="#delivery" data-toggle="tab">Доставка </a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            <div class="col-sm-12">

                                <table id="prod_params" class="table table-hover table-striped" style="margin: 10px auto;width:100%;line-height:16px;font-size:14px;color:#131211;">
                                    <tbody><tr class="prod_arrt_row">
                                        <td class="prod_arrt_left" oncontextmenu="return false" onselectstart="return false" valign="top">Материал</td>
                                        <td class="prod_arrt_right"  oncontextmenu="return false" onselectstart="return false" valign="top"><?=$product->material?></td></tr><tr class="prod_arrt_row">
                                        <td class="prod_arrt_left" oncontextmenu="return false" onselectstart="return false" valign="top">Цвет</td>
                                        <td class="prod_arrt_right" oncontextmenu="return false" onselectstart="return false" valign="top"><?=$product->color?></td></tr><tr class="prod_arrt_row">
                                        <td class="prod_arrt_left" oncontextmenu="return false" onselectstart="return false" valign="top">Бренд</td>
                                        <td class="prod_arrt_right" oncontextmenu="return false" onselectstart="return false" valign="top"><?=$product->brand?></td></tr><tr class="prod_arrt_row">
                                        <td class="prod_arrt_left" oncontextmenu="return false" onselectstart="return false" valign="top">Предназначение</td>
                                        <td class="prod_arrt_right" oncontextmenu="return false" onselectstart="return false" valign="top"><?=$product->predestination?></td></tr>
                                    </tbody>
                                </table>

                                <?php if($product->content) { echo $product->content; }?>
                            </div>
                        </div>

                        <div class="tab-pane fade active in" id="companyprofile" >
                            <?php if (!empty($otherProducts)): ?>
                                <?php foreach ($otherProducts as $otherProduct): ?>
                                <?php
                                    $otherProductImg = $otherProduct->getImage();
                                    ?>
                                    <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                    <a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $otherProduct['id']])?>">
                                                    <?=Html::img($otherProductImg->getUrl(), ['alt'=> $otherProduct->name])?>
                                                    </a>
                                                <span class="price"><?=PriceHelper::from($otherProduct->price)?></span>
                                                <p><a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $otherProduct['id']])?>"><?= $otherProduct['name'] ?></a></p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавть в корзину</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h3>Извините, похожих товаров сейчас нет.</h3>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane fade " id="reviews" >
                            <div class="col-sm-12">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.10";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>

                                <div class="fb-comments" data-href="<?=\yii\helpers\Url::to(['product/view', 'id' => $product->id])?>" data-numposts="5"></div>

                            </div>
                        </div>
                        <div class="tab-pane fade " id="delivery" >
                            <div class="col-sm-12">
                                <div class="">
                                    <p><b>Доставка:</b></p>
                                    <ul>
                                        <li> &#9679; 40 гривен в любую точку Украины</li>
                                        <li> &#9679; Новая почта либо УкрПочта</li>
                                        <li> &#9679; Отправка заказа не позднее чем через 10 дней</li>
                                        <li> &#9679; Оплата при получении</li>
                                    </ul>
                                    <p><b>Возврат и обмен:</b></p>
                                    <ul>
                                        <li> &#9679; обмен/возврат товара в течение 14 дней</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="sizes" >
                            <div class="table-responsive col-sm-12">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Размер</td>
                                        <td>Рост (см)</td>
                                        <td>Вес (кг)</td>
                                    </tr>
                                    <tr>
                                        <td>Preemie (P)</td>
                                        <td>до 43</td>
                                        <td>до 2.3</td>
                                    </tr>
                                    <tr>
                                        <td>Newborn (NB)</td>
                                        <td>до 55</td>
                                        <td>2.3 - 3.6</td>
                                    </tr>
                                    <tr>
                                        <td>3M</td>
                                        <td>55 - 61</td>
                                        <td>3.6 - 5.7</td>
                                    </tr>
                                    <tr>
                                        <td>6M</td>
                                        <td>61 - 67</td>
                                        <td>5.7 - 7.5</td>
                                    </tr>
                                    <tr>
                                        <td>9M</td>
                                        <td>67 - 72</td>
                                        <td>7.5 - 9.3</td>
                                    </tr>
                                    <tr>
                                        <td>12M</td>
                                        <td>72 -78</td>
                                        <td>9.3 - 11.1</td>
                                    </tr>
                                    <tr>
                                        <td>18M</td>
                                        <td>78 - 83</td>
                                        <td>11.1 - 12.5</td>
                                    </tr>
                                    <tr>
                                        <td>24M</td>
                                        <td>83 - 86</td>
                                        <td>12.5 - 13.6</td>
                                    </tr>
                                    <tr>
                                        <td>36M</td>
                                        <td>88 - 92</td>
                                        <td>13.5 - 14.9</td>
                                    </tr>
                                    <tr>
                                        <td>48M</td>
                                        <td>93 - 101</td>
                                        <td>15.1 - 16.7</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;Размер</td>
                                        <td>Рост (см)</td>
                                        <td>Вес (кг)</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;2 года</td>
                                        <td>88 - 93</td>
                                        <td>13.2 - 14.1</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;3 года</td>
                                        <td>93 - 98</td>
                                        <td>14.1 - 15.4</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;4 года</td>
                                        <td>98 - 105</td>
                                        <td>15.4 - 17.2</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;5 лет</td>
                                        <td>105 - 111</td>
                                        <td>17.2 - 19.1</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="19">Размер</td>
                                        <td>Рост (см)</td>
                                        <td>Вес (кг)</td>
                                    </tr>
                                    <tr>
                                        <td>4&nbsp;<span>kids</span></td>
                                        <td>102 - 108</td>
                                        <td>16.8 - 17.7</td>
                                    </tr>
                                    <tr>
                                        <td>5&nbsp;<span>kids</span></td>
                                        <td>108 - 114</td>
                                        <td>17.7 - 20</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>114 - 122</td>
                                        <td>20 - 22</td>
                                    </tr>
                                    <tr>
                                        <td>6X</td>
                                        <td>122 - 124</td>
                                        <td>22 - 24</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>124 - 130</td>
                                        <td>24 - 27</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>130 - 137</td>
                                        <td>27 - 32</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>137 - 142</td>
                                        <td>32 - 40</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>142 - 150</td>
                                        <td>40 - 45</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/category-tab-->

                <!--recommended_items-->
                <div class="recommended_items">
                    <h2 class="title text-center">Популярные товары</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = count($hits); $i = 0; foreach ($hits as $hit): ?>
                                <?php if ($i % 3 == 0): ?>
                                    <div class="item <?php if ($i == 0) echo "active"?>">
                                <?php endif; ?>

                                <?php $mainImg = $hit->getImage(); ?>

                                <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $hit->id])?>">
                                                    <?=Html::img($mainImg->getUrl(), ['alt' => $hit->name])?>
                                                    </a>
                                                    <span class="price"><?= PriceHelper::from($hit['price'])?></span>
                                                    <p><a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $hit['id']])?>"><?=$hit['name']?></a></p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в корзину</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++; ?>
                                <?php if ($i % 3 == 0 || $count == $i): ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    </div>
                    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                    </div>
                </div>
                <!--/recommended_items-->
            </div>
        </div>
    </div>
</section>