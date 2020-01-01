<?php
namespace app\admin\controller;

use think\Controller;
use think\View;
use think\Request;
use app\admin\model\Admin;

/**
* 登陆注册
* author：uncle_z
*/
class Login extends AdminController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    //注册
    public function register()
    {   
        if($this->request->isPost()){
            $hasname = Admin::where('username',$this->request->param('username'))->find();
            if($hasname){
               $this->error('用户名'. $this->request->param('username') .'已经存在', '/admin/login/register');
                return;
            }
            if($this->request->param('password') === $this->request->param('pwdconfirm')){
                $admin = new Admin($this->request->param());
                $info = $admin->allowField(['username','password'])->save();
                $this->success('注册成功,去登录！', 'admin/login/login');
            }else{
                $this->error('两次密码不相同', '/admin/login/register');
            }           
        }else{
            return view('login.register');
        }
    }
    //登陆
    public function login()
    {
        if($this->request->isPost()){
            $user = new Admin();
            // 查询单个数据
            $info = $user->where('username', $this->request->param('username'))->find();
            
            if(!$info){
               $this->error('用户名'. $this->request->param('username') .'不存在', '/admin/login/login');
                return;
            }
            $info = $info->toArray();
            if($this->request->param('password') === $info['password']){
                $this->success('登录成功！', '/admin');
            }else{
                $this->error('密码错误，请重试', '/admin/login/login');
            }
        }else{
            return view('login');
        }
    }

    public function logout()
    {
        return view('login');
    }
}

?>