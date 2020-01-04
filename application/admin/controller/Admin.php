<?php 
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\User;
/**
* 后台母控制器
* author: uncle_z
*/
define('IN_ADMIN',true);

class Admin extends Controller
{
    public $userid;
    public $user;
    public $request;

    public function __construct(Request $request,User $user)
    {
        $this->request = $request;
        $this->user = $user;
        self::check_admin();
        self::check_priv();
        self::check_hash();
        self::check_ip();
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
