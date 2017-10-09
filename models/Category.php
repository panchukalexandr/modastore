<?php 
namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public $image;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
            'cache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 3600
            ]
        ];
    }

	public static function tableName() 
	{
		return 'category';
	}

	public static function getIdByAlias($alias)
    {
        $aliasItem = Category::find()->where(['alias' => $alias]);
        if ($aliasItem->one())
        {
            return $aliasItem->one()->id;
        }
    }

    public static function getParentCategory($id)
    {
        return Category::findOne($id);
    }


	// это связка категории к вродуктам
	// через метод hasMany будем вытягивать все товары для катгории
	// category_id - поле в таблице продуктов
	// id  - поле в таблице категорий 
	public function getProducts()
	{
		return $this->hasMany(Product::className(), ['category_id' => 'id']);
	}


}