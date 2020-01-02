<?php
namespace app\admin\model;

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
    
}


?>