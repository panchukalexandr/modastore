<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'category_id',
                'value' => function($data){
                    return $data->category->name;
                }
            ],
            [
                'attribute' => 'image',
                'value' => function($data) {
                    $img = $data->getImage('20*20');
                    return Html::img($img->getUrl(), ['width' => 30, 'height' => 30]);
                },
                'format' => 'html'
            ],


            [
                'attribute' => 'name',
                'value' => function ($data){
                    return '<a href="/product/'.$data['id'].'"> '.$data['name'].'</a>';
                },
                'format' => 'html'

            ],
            [
                'attribute' => 'price',
                'value' => function ($data) {
                    return \app\components\helper\PriceHelper::from($data->price);
                }
            ],
            [
                'attribute' => 'hit',
                'value' => function($data){
                    return !$data->hit ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
            'format' => 'html'
            ],
            [
                'attribute' => 'new',
                'value' => function($data){
                    return !$data->new ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
            'format' => 'html'
            ],
            [
                'attribute' => 'sale',
                'value' => function($data){
                    return !$data->sale ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
            'format' => 'html'
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
