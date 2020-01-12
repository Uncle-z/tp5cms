<?php
namespace app\admin\model;

use think\Db;
use think\Model;

/**
* author: uncle;
* time: 2019-12-30
*/

class Role extends Model
{
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    /*
    * 角色关联用户
    */
   	public function users()
    {
   		return $this->hasMany('User','roleid');
   	}

    public function getRoles($page = 1, $limit = 10)
    {
      return Db::name('role')->field(['roleid','rolename'])->page($page,$limit)->order('roleid asc')->select();
    }
}
?>