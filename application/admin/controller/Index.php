<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\Role;
use app\admin\model\User;
/*
* author: uncle;
* time: 2020-01-01;
*/
class Index extends Admin
{
    //后台模板
    public function index()
    {
        $rolename = Role::where('roleid',session('roleid'))->value('rolename');
        return view('main/home',['username' => cookie('admin_username'), 'rolename' => $rolename]);
    }
    //后台消息看板
    public function board()
    {
        //dump($this->request->server());
        return view('board',['PHP_OS' => PHP_OS, 'server_info' => $this->request->server('SERVER_SOFTWARE'), 'tp_v' => THINK_VERSION]);
    }
    /*
    * 登录
    */
    public function login()
    {
        if($this->request->isPost()){
            if(!$this->request->param('username')){
                $this->error('请输入用户名', '/admin/index/login');
                return;
            }

            // 查询用户
            $user = User::get(['username' => $this->request->param('username')]);
            
            if(!$user){
               $this->error('用户名'. $this->request->param('username') .'不存在', '/admin/index/login');
                return;
            }

            $password = md5(md5(trim($this->request->param('password'))).$user->encrypt);

            if($password === $user->password){
                session('userid', $user->userid);
                session('roleid', $user->roleid);
                cookie('admin_username', $user->username, 10800);
                cookie('userid', $user->userid, 10800);
                $this->user->save([
                    'lastloginip'  => $this->request->ip(),
                    'lastlogintime' => time()
                ],['userid' => $user->userid]);

                $this->success('登录成功！', '/admin');
            }else{
                $this->error('密码错误，请重试', '/admin/index/login');
            }
        }else{
            return view('login');
        }
    }
    /*
    * 退出
    */
    public function logout()
    {
        session('userid', null);
        session('roleid', null);
        cookie('userid', null);
        cookie('admin_username', null);
        $this->success('退出成功！', '/admin/index/login');
    }

}
