<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class Module extends Model
{
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    //获取所有模型
    public function getModules($page = 1, $limit = 20)
    {
        $modules = Db::name('module')->page($page,$limit)->order('moduleid asc')->select();
        return $modules;
    }
    /*
    * 获取某个模型信息
    */
    public function getModule($id){
        $module = Db::name('modules')->where('modulesid', $id)->find();
        return $module;
    }
}
