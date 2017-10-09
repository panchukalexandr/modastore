<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 29.07.17
 * Time: 16:54
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{

    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $news = Product::find()->where(['new' => '1'])->limit(6)->all();

//        $dataProviderNews = new ActiveDataProvider([
//            'query' => Product::find()->where(['new' => '1'])->limit(6)
//        ]);

        $this->setMeta(
            'Интернет магазин одежды для детей, мужчин и женщин в Украине: купить в Киеве и других городах Украины по выгодной цене — imoda-store.com',
            '',
            'Интернет магазин одежды imoda-store.com | ✔Выгодные цены ✔Отличное качество ✔Доставка по Украине! ☎ +38 (063) 314-89-62'
        );
        return $this->render('index', compact('hits', 'news'));
    }

    public function actionView($id)
    {

        $category = Category::findOne(['id' => $id]);

        if ($category === null) {
            throw new HttpException(404, 'not category');
        }

        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->view->params['breadcrumbs'] = [
            ['label' => $category->name]
        ];


//        $this->setMeta('E-SHOPPER | '.$category->name, $category->keywords, $category->description);
        $this->setMeta(
            $category->name.' - купить в Киеве и Украине, цены на '.$category->name.' в каталоге 2017 интернет магазина imoda-store.com' ,
            $category->keywords,
            $category->name.' – лучший интернет шопинг для Вас в магазине imoda-store.com! ✓ Качество! ✓ Доступность! ✓ Быстрая доставка! Звоните ☎ +38 (063) 314-89-62');

        return $this->render('view', compact('products', 'category', 'pages'));
    }


    public function actionSearch()
    {
        $queryUser = trim( Yii::$app->request->get('queryUser'));
        if (!$queryUser) {
            $pages = null;
            return $this->render('search', compact('queryUser', 'pages'));
        }

        $query = Product::find()->where(['like', 'name', $queryUser]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 6,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', compact('products', 'pages', 'queryUser'));
    }



}