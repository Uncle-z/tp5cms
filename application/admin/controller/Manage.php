<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\User;
/**
*author: uncle;
*time: 2020-01-01;
*/

class Manage extends Admin
{
	public function index()
    {
        return view('index');
    }

    /*
    *	添加后台管理员
    */
	public function add()
	{
		if($this->request->isPost()){
            $hasname = $this->user->where('username',$this->request->param('username/s'))->find();
            if($hasname){
               $this->error('用户名'. $this->request->param('username') .'已经存在', '/admin/manage/add');
                return;
            }
            if(!is_password($this->request->param('password/s'))){
            	$this->error('密码长度需要大于6个且小于20个字符', '/admin/manage/add');
            	return;
            }

            if($this->request->param('password/s') === $this->request->param('pwdconfirm/s')){
            	$password = password($this->request->param('password'));
                $this->request->post(['password' => $password['password']]);
                $this->request->post(['encrypt'  => $password['encrypt']]);
                $user = new User($this->request->param());
                $info = $user->allowField(['username', 'password', 'encrypt'])->save();
                if($info) $this->success('注册成功,去登录！', 'admin/index/login');
                $this->error('服务器错误，请重试', '/admin/manage/add');
            }else{
                $this->error('两次密码不相同', '/admin/manage/add');
            }           
        }else{
            return view('login/register');
        }
	}
}

?>