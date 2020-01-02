<?php
namespace app\admin\controller;
use app\admin\controller\Admin as AdminController;
use app\admin\model\Admin;
/*
* author: uncle;
* time: 2020-01-01;
*/
class Index extends AdminController
{
    //后台模板
    public function index()
    {
        return view('main/home');
    }
    //后台模板首页
    public function pageIndex()
    {
        return view('pageindex');
    }

    public function login()
    {
        if($this->request->isPost()){
            if(!$this->request->param('username')){
                $this->error('请输入用户名', '/admin/index/login');
                return;
            }

            $user = new Admin();
            // 查询单个数据
            $info = $user->where('username', $this->request->param('username'))->find();
            
            if(!$info){
               $this->error('用户名'. $this->request->param('username') .'不存在', '/admin/index/login');
                return;
            }
            $info = $info->toArray();

            $password = md5(md5(trim($this->request->param('password'))).$info['encrypt']);

            if($password === $info['password']){
                $this->success('登录成功！', '/admin');
            }else{
                $this->error('密码错误，请重试', '/admin/index/login');
            }
        }else{
            return view('login');
        }
    }

}
