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
    /*
    * 角色关联信息获取
    */
    public function getRoles($page = 1, $limit = 10)
    {
      $roles = Db::name('role')->field(['roleid','rolename'])->page($page,$limit)->order('roleid asc')->select();
      return $roles;
    }
    /*
    * 获取单个角色
    */
    public function getRole($id)
    {
      $role = Db::name('role')->where('roleid',$id)->find();
      return $role;
    }
    /*
    * 获取角色信息
    */
    public function asyncGetRoles($page = 1, $limit = 10)
    {
      $roles = Db::name('role')->page($page,$limit)->order('roleid asc')->select();
      foreach ($roles as &$role) {
         $role['disable'] = $role['disable'] == 0 ? '禁用' : '启用';
      }

      return [
          "code" => 0,
          "msg"  => "success",
          "count"=> Db::name('role')->count(),
          "data" => $roles
      ];
    }
}
?>