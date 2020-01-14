<?php
namespace app\admin\model;
use think\Db;
use think\Model;

/**
* author: uncle;
* time: 2019-12-30
*/

class Menu extends Model
{

    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    /*
    * 获取菜单信息
    */
    public function asyncGetMenus($page = 1, $limit = 10)
    {
        $menus = Db::name('menu')->page($page,$limit)->order('menuid asc')->select();
        foreach ($menus as &$menu) {
            $menu['display'] = $menu['display'] == 0 ? '隐藏' : '显示';
        }

        return [
            "code" => 0,
            "msg"  => "success",
            "count"=> Db::name('menu')->count(),
            "data" => $menus
        ];
    }
    /*
    * 获取关联菜单
    */
    public function getMenus()
    {
        $menus = Db::name('menu')->order('menuid asc')->select();
        foreach ($menus as &$menu) {
            $menu['display'] = $menu['display'] == 0 ? '隐藏' : '显示';
        }
        return $menus;
    }
    /*
    * 获取菜单菜单
    */
    public function getMenu($id)
    {
        $menu = Db::name('menu')->where('menuid', $id)->find();
        return $menu;
    }
}


?>