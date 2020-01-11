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
}


?>