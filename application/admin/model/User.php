<?php
namespace app\admin\model;

use think\Model;
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
}


?>