<?php
namespace app\admin\model;

use think\Model;

/**
* author: uncle;
* time: 2019-12-30
*/

class Category extends Model
{

    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    /*
    * 异步获取栏目信息
    */
    public function asyncGetCate($page = 1, $limit = 10)
    {
        $categories = Db::name('categroy')->page($page,$limit)->order('cateid asc')->select();
        foreach ($categories as &$cate) {
            $cate['display'] = $cate['display'] == 0 ? '隐藏' : '显示';
        }

        return [
            "code" => 0,
            "msg"  => "success",
            "count"=> Db::name('categroy')->count(),
            "data" => $categories
        ];
    }
    /*
    * 获取所有栏目
    */
    public function getAllCate($noid)
    {
        $categories = Db::name('categroy')->where('cateid', '<>', $noid)->order('cateid asc')->select();
        foreach ($categories as &$cate) {
            $cate['display'] = $cate['display'] == 0 ? '隐藏' : '显示';
        }
        return $categories;
    }
    /*
    * 获取菜单菜单
    */
    public function getCate($id)
    {
        $cate = Db::name('categroy')->where('cateid', $id)->find();
        return $cate;
    }
}


?>
