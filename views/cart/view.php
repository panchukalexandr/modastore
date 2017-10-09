<?php

use app\components\helper\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <?php echo Yii::$app->session->getFlash('success');?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <?php echo Yii::$app->session->getFlash('error');?>
        </div>
    <?php endif; ?>


    <?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Название</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Сумма</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $product): ?>
                <tr>
                    <td>
                        <?= Html::img($product['img'], ['alt' => $product['name'], 'height' => 50]) ?>
                    </td>
                    <td><a href="<?=Url::to(['product/view', 'id' => $id])?>"><?=$product['name']?></a></td>
                    <td><?=$product['qty']?></td>
                    <td><?=$product['price']?></td>
                    <td><?=$product['price'] * $product['qty']?></td>
                    <td><span data-id="<?=$id?>" id="del-cart" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Итого: </td>
                <td><?=$session['cart.qty']?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4">На сумму: </td>
                <td><?= PriceHelper::from($session['cart.sum'])?></td>
                <td></td>
            </tr>
            </tbody>

        </table>
    </div>
        <hr>

        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($order, 'name') ?>
        <?= $form->field($order, 'email') ?>
        <?= $form->field($order, 'phone') ?>
        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success']) ?>
        <?php  ActiveForm::end(); ?>
        <br>
    <?php else: ?>
        <div class="row ">
            <div class="col-sm-6">
                <h3>Извините, но в Вашей корзине пусто.</h3>
                Перейдите в категорию, которая вас интересует в меню сверху.
            </div>
            <div class="empty-cart col-sm-6">
                <div style="height: 500px"></div>
            </div>
        </div>
    <?php endif; ?>
</div>
