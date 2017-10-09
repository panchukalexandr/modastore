<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 04.10.17
 * Time: 11:33
 */

namespace app\components;


use app\models\Category;
use Yii;
use yii\jui\Widget;

class MenuWidgetN extends Widget
{
    public $tpl;

    /** @var $data array */
    public $data;

    /** @var $tree */
    public $tree;
    public $menuHtml;
    public $model;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if ($this->tpl == null) {
            $this->tpl = 'menun';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        // get cache
        if ($this->tpl == 'menun.php') {
            $menu = Yii::$app->cache->get('menun');
            if ($menu) return $menu;
        }

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //         set cache
        if ($this->tpl == 'menun.php') {
            Yii::$app->cache->set('menun', $this->menuHtml, 60 * 8);
        }

        return $this->menuHtml;
    }


    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (isset($node['parent_id']))
                if (!$node['parent_id']) {
                    $tree[$id] = &$node;
                } else {
                    $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
                }
        }

        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }

        return $str;


    }

    protected function catToTemplate($category, $tab)
    {
        ob_start();
        include __DIR__.'/menu_tpl/'.$this->tpl;
        return ob_get_clean();

    }


}