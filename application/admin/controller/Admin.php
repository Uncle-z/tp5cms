<?php 
namespace app\admin\controller;
use think\Controller;
/**
* Admin controller
* author: uncle_z
*/
define('IN_ADMIN',true);

class Admin extends Controller
{
    protected $user;//用户
    protected $role;//角色
    protected $auth;//权限
    public function __construct()
    {
        $this->request = request();
        self::check_admin();//检查登陆
        self::check_auth(); //检查权限
        self::check_hash(); //检查哈希
        self::check_ip();   //检查ip
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
    final public function check_auth() {
        return false;
    }
    /**
     * 检查hash值，验证用户数据安全性
     */
    final private function check_hash() {
        return false;
    }
    /**
     * 后台IP禁止判断 ...
     */
    final private function check_ip(){
        return false;
    }
}













?>
