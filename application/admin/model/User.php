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

    public function getUsers() 
    {
    	$users = Db::name('user')->field(['password','encrypt'],true)->select();
    	foreach ($users as &$user) {
    		$user['rolename'] = Db::name('role')->where('roleid',$user['roleid'])->value('rolename');
    	}
    	return $users;
    }
}


?>