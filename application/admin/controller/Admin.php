<?php 
namespace app\admin\controller;
use think\Controller;
use think\Request;

/**
* 后台母控制器
* author: uncle_z
*/
define('IN_ADMIN',true);

class Admin extends Controller
{
    public $userid;
    public $username;
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        self::check_admin();
        self::check_priv();
    }

    /**
     * 判断用户是否已经登陆
     */
    final public function check_admin() {
        if($this->request->module() =='admin' && $this->request->controller() =='Index' && $this->request->action() =='login') {
            return true;
        } else {
            $userid = cookie('userid');
            if(!session('?userid') || !session('?roleid') || !session('userid') || !session('roleid') || $userid != session('userid')) {
                $this->redirect('/admin/index/login');
            }
        }
        
    }

    /**
     * 判断用户是否有权限
     */
    final public function check_priv() {

    }
}













?>
