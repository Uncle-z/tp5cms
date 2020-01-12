<?php
namespace app\admin\model;

use think\Model;
use think\Db;
use traits\model\SoftDelete;

/**
* author: uncle;
* time: 2019-12-30
*/

class User extends Model
{
    protected $readonly = ['username'];
    protected $deleteTime = 'delete_time';
    
    protected function initialize()
    {
        parent::initialize();
    }
    /*
    * 获取所有管理员信息
    */
    public function getUsers($page = 1, $limit = 10)
    {
    	$users = Db::name('user')->field(['password','encrypt'],true)->page($page,$limit)->order('userid desc')->select();
    	foreach ($users as &$user) {
            $user['rolename'] = Db::name('role')->where('roleid',$user['roleid'])->value('rolename');
    		$user['lastlogintime'] = $user['lastlogintime'] ? date('Y-m-d H:i:s', $user['lastlogintime']) : '尚未登录过账号';
    	}
        
        return [
            "code" => 0,
            "msg"  => "success",
            "count"=> Db::name('user')->count(),
            "data" => $users
        ];
    }
    /*
    * 获取某个管理员信息
    */
    public function getUser($id){
        $user = Db::name('user')->field(['password','encrypt'],true)->where('userid', $id)->find();
        return $user;
    }
    /*
    * 更新单个管理员密码
    */
    public function updatePwd($id, $pwd)
    {
        $c_pwd = password($pwd);
        $info = Db::name('user')->where('userid', $id)->update(['password' => $c_pwd['password'], 'encrypt' => $c_pwd['encrypt']]);
        return $info;
    }
    /*
    * 更新单个管理员资料
    */
    public function updateMaterial($id, $roleid, $realname, $email)
    {
        $info = Db::name('user')->where('userid', $id)->update(['roleid' => $roleid, 'realname' => $realname, 'email' => $email]);
        return $info;
    }
}


?>