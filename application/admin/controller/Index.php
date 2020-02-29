<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\Role;
use app\admin\model\User;
use app\admin\model\Menu as MenuModel;
use BlueM\Tree;
/*
* author: uncle;
* time: 2020-01-01;
*/
class Index extends Admin
{

    function __construct(User $user, MenuModel $menu)
    {
        parent::__construct();
        $this->user = $user;
        $this->menu = $menu;
    }
    //后台模板
    public function index()
    {
        $menus = $this->menu->getMenus('0');
        $tree = new Tree($menus, ['id' => 'menuid', 'parent' => 'parentid']);
        $nodes = $tree->getRootNodes();
        //$nodes = $tree->getNodes();
        foreach ($nodes as &$node) {
            $node->level = $node->getLevel();
            $node->following = $node->getFollowingSibling();
            //$parentNode = $node->getParent();
            //$parentFlowing = $parentNode->parent ? $parentNode->getFollowingSibling() : null;
            //$node->space = $parentFlowing ? getSpace($node->level, true) : getSpace($node->level, false);
        }
        //dump($nodes);
        $rolename = Role::where('roleid',session('roleid'))->value('rolename');
        return view('main/home',['username' => cookie('admin_username'), 'rolename' => $rolename, 'nodes' => $nodes]);
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
                $this->error('请输入用户名', '/login');
                return;
            }

            // 查询用户
            $user = User::get(['username' => $this->request->param('username')]);
            
            if(!$user){
               $this->error('用户名'. $this->request->param('username') .'不存在', '/login');
                return;
            }

            $password = md5(md5(trim($this->request->param('password'))).$user->encrypt);

            if($password === $user->password){
                session('userid', $user->userid);
                session('roleid', $user->roleid);
                cookie('admin_username', $user->username);
                cookie('userid', $user->userid);
                $this->user->save([
                    'lastloginip'  => $this->request->ip(),
                    'lastlogintime' => time()
                ],['userid' => $user->userid]);

                $this->success('登录成功！', '/admin');
            }else{
                $this->error('密码错误，请重试', '/login');
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
        $this->success('退出成功！', '/login');
    }

}
