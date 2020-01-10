<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\User;
use app\admin\model\Role;
/**
*author: uncle;
*time: 2020-01-01;
*/
class Manage extends Admin
{

    function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }
    /*
    *   查看多有管理人员
    */
	public function index()
    {
        $user = new User();
        $users = $user->getUsers();

        if($this->request->isAjax()){
            return [
                "code" => 0,
                "msg"  => "success",
                "count"=> User::count(),
                "data" => $users
            ];
        }
        return view('index');
    }
    /*
    * 个人资料
    */
    public function profile()
    {   
        $user = User::get(session('userid'));
        $roles = Role::where('disable',0)->column('roleid,rolename');
        if($this->request->isPost()){
            $user->save([
                'roleid' => $this->request->param('roleid'), 
                'realname' => $this->request->param('realname'), 
                'email' => $this->request->param('email')
            ],['userid' => session('userid')]);
        }
        return view('profile',['user' => $user, 'roles' => $roles]);
    }
    /*
    * 修改密码
    */
    public function editPwd()
    {
        $user = User::get(session('userid'));
        $roles = Role::where('disable',0)->column('roleid,rolename');
        if($this->request->isPost()){
            $password = md5(md5(trim($this->request->param('password'))).$user->encrypt);
            //校验旧密码
            if($user->password === $password){
                if($this->request->param('newpassword') === $this->request->param('rnewpassword')){
                    $newpassword = password($this->request->param('newpassword'));
                    $this->user->save([
                        'password' => $newpassword['password'],
                        'encrypt' => $newpassword['encrypt']
                    ],['userid' => session('userid')]);
                    $this->success('密码修改成功', '/admin/manage/editPwd');
                }else{
                    $this->error('两次密码不相同', '/admin/manage/editPwd');
                }
            }else{
                $this->error('旧密码输入不正确', '/admin/manage/editPwd');
            }
        }

        return view('edit_pwd', ['user' => $user]);
    }
	/*
    * 创建用户
    */
    public function create()
    {
        if($this->request->isPost()){
            $hasname = $this->user->where('username',$this->request->param('username/s'))->find();
            if($hasname){
                return ['status' => 'fail', 'mesg' => '用户名'. $this->request->param('username') .'已经存在'];
            }

            if(!is_password($this->request->param('password/s'))){
                return ['status' => 'fail', 'mesg' => '密码长度需要大于6个且小于20个字符'];
            }

            if($this->request->param('password/s') === $this->request->param('pwdconfirm/s')){

                $password = password($this->request->param('password'));
                $this->request->post(['password' => $password['password']]);
                $this->request->post(['encrypt'  => $password['encrypt']]);
                $user = new User($this->request->param());
                $info = $user->allowField(true)->save();

                if($info) return ['status' => 'success', 'mesg' => $info];
                return ['status' => 'error', 'mesg' => '服务器错误，请刷新重试'];

            }else{
                return ['status' => 'fail', 'mesg' => '两次密码不相同,请检查密码！'];
            }           
        }else{
            $role = new Role();
            return view('create', ['roles' => $role->getRoles()]);
        }
    }
    /*
    * 编辑用户信息
    */
    public function edit()
    {

    }
    /*
    * 删除
    */
    public function delete()
    {

    }
}

?>