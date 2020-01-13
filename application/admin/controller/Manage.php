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

    function __construct(User $user, Role $role)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
    }
    /*
    *   查看多有管理人员
    */
	public function index()
    {

        if($this->request->isAjax()){
            return $this->user->getUsers($this->request->param('page'), $this->request->param('limit'));
        }
        
        return view('index');
    }
    /*
    * 个人资料
    */
    public function profile()
    {   
        $user = User::get(session('userid'));
        $roles = $this->role->getRoles();

        if($this->request->isPost()){
            $this->user->updateMaterial($user->userid, $user->roleid, $this->request->param('realname'), $this->request->param('email'));
        }
        return view('profile',['user' => $user, 'roles' => $roles]);
    }
    /*
    * 修改密码
    */
    public function editPwd()
    {
        $user = User::get(session('userid'));
        $roles = $this->role->getRoles();

        if($this->request->isPost()){
            $password = md5(md5(trim($this->request->param('password'))).$user->encrypt);
            //校验旧密码
            if($user->password === $password){
                if($this->request->param('newpassword') === $this->request->param('rnewpassword')){
                    $info = $this->user->updatePwd($user->userid, $this->request->param('newpassword'));
                    if($info) $this->success('密码修改成功', '/editPwd');
                }else{
                    $this->error('两次密码不相同', '/editPwd');
                }
            }else{
                $this->error('旧密码输入不正确', '/editPwd');
            }
        }
        return view('edit_pwd', ['user' => $user]);
    }
    /*
    * 创建用户
    */
    public function create()
    {
        return view('create', ['roles' => $this->role->getRoles()]);
    }
	/*
    * 保存创建用户
    */
    public function save()
    {
        if($this->request->isPost()){

            if(!is_username($this->request->param('username/s'))){
                $this->error('用户名'. $this->request->param('username') .'不符合规范，请更换', '/manage/create');
                return ;
                //return ['status' => 'fail', 'mesg' => '用户名'. $this->request->param('username') .'不符合规范，请更换'];
            }
            
            $hasname = $this->user->where('username',$this->request->param('username/s'))->find();
            if($hasname){
                $this->error('用户名'. $this->request->param('username') .'已经存在', '/manage/create');
                return ;
                //return ['status' => 'fail', 'mesg' => '用户名'. $this->request->param('username') .'已经存在'];
            }

            if(!is_password($this->request->param('password/s'))){
                $this->error('密码长度需要大于6个且小于20个字符', '/manage/create');
                return ;
                //return ['status' => 'fail', 'mesg' => '密码长度需要大于6个且小于20个字符'];
            }

            if($this->request->param('password/s') === $this->request->param('pwdconfirm/s')){

                $password = password($this->request->param('password'));
                $this->request->post(['password' => $password['password']]);
                $this->request->post(['encrypt'  => $password['encrypt']]);
                $user = new User($this->request->param());
                $info = $user->allowField(true)->save();

                if($info) return $this->success('添加成功', '/manage');
                //if($info) return ['status' => 'success', 'mesg' => $info];
                $this->error('用户名'. $this->request->param('username') .'不符合规范，请更换', '/manage/create');
                return ;
                //return ['status' => 'error', 'mesg' => '服务器错误，请刷新重试'];

            }else{
                $this->error('用户名'. $this->request->param('username') .'不符合规范，请更换', '/manage/create');
                return ;
                //return ['status' => 'fail', 'mesg' => '两次密码不相同,请检查密码！'];
            }           
        }
    }
    /*
    * 编辑用户信息
    */
    public function edit()
    {
        $user = $this->user->getUser($this->request->param('id'));
        $roles = $this->role->getRoles();
        if($this->request->param('do') === 'edit'){

            $this->user->updateMaterial(
                $user['userid'], 
                $this->request->param('roleid'),
                $this->request->param('realname'),
                $this->request->param('email'));

            $pwd = $this->request->param('password');
            $pwdCon = $this->request->param('pwdconfirm');

            if($pwd && $pwd === $pwdCon){
                $this->user->updatePwd($user['userid'], $pwd);
            }else if($pwd && $pwd != $pwdCon){
                $this->error('两次密码不同，密码修改失败', '/manage/'.$user['userid'].'/edit');
            }

            $this->success('修改成功', '/manage');
        }
        return view('edit',['user' => $user, 'roles' => $roles]);
    }
    /*
    * 删除
    */
    public function delete()
    {
        if($this->request->isAjax()){
            $id = $this->request->param('id');
            $a_f = config('admin_founder');

            if(in_array($id, $a_f)){
                return ['status' => 'fail', 'msg' => '当前管理员禁止删除！'];
            }else{
                $info = User::destroy($id);
                return ['status' => 'success', 'msg' => $info];
            }
        }
    }
}

?>