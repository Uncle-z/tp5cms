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
    /*
    * 个人资料
    */
    public function profile()
    {
        return $this->hasOne('Role');
    }
}


?>