<?php 
namespace app\admin\controller;

use think\Controller;
use think\View;

/**
* 后台母控制器
* author: uncle_z
*/
define('IN_ADMIN',true);

class Admin extends Controller
{
    public $userid;
    public $username;

    public function _initialize()
    {
        self::check_admin();
        self::check_priv();
    }

    /**
     * 判断用户是否已经登陆
     */
    final public function check_admin() {
        // if(ROUTE_M =='admin' && ROUTE_C =='index' && in_array(ROUTE_A, array('login', 'public_card'))) {
        //     return true;
        // } else {
        //     $userid = param::get_cookie('userid');
        //     if(!isset($_SESSION['userid']) || !isset($_SESSION['roleid']) || !$_SESSION['userid'] || !$_SESSION['roleid'] || $userid != $_SESSION['userid']) showmessage(L('admin_login'),'?m=admin&c=index&a=login');
        // }
        if(!isset($_SESSION['userid']) || !isset($_SESSION['roleid']) || !$_SESSION['userid'] || !$_SESSION['roleid'] || $userid != $_SESSION['userid']) {
            //dump('session');
            $this->redirect('admin/login/login');
        };
    }

    /**
     * 判断用户是否有权限
     */
    final public function check_priv() {

    }
}













?>
