<?php
namespace app\admin\model;

use think\Model;

/**
* author: uncle;
* time: 2019-12-30
*/

class User extends Model
{
    
    protected function initialize()
    {
        parent::initialize();
    }

    //protected $readonly = ['name','email'];
    
    public function index()
    {
        //return $admin = model('admin');
    }

    /*
    *创建用户
    */
    public function add()
    {
        //return request()->param();
    }
}


?>