<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\Role as RoleModel;

/**
*author: uncle;
*time: 2020-01-12;
*/

class Role extends Admin
{

    function __construct(RoleModel $role)
    {
        parent::__construct();
        $this->role = $role;
    }
    /*
    * 获取所有角色
    */
    public function index()
    {
    	if($this->request->isAjax()){
    		return $this->role->asyncGetRoles($this->request->param('page'), $this->request->param('limit'));
    	}
    	return view('index');
    }
    /*
    * 新建角色
    */
    public function create()
    {
        return view('create');
    }
    /*
    * 保存角色
    */
    public function save()
    {
    	if($this->request->isPost()){
	    	if(!is_username($this->request->param('rolename/s'))){
	                $this->error('角色名称[ '. $this->request->param('rolename') .' ]不符合规范，请更换', '/role/create');
	                return ;
	            }
	            
	        $hasname = $this->role->where('rolename',$this->request->param('rolename/s'))->find();
	        if($hasname){
	            $this->error('角色名称[ '. $this->request->param('rolename') .' ]已经存在', '/role/create');
	            return ;
	        }

	        $role = new RoleModel($this->request->param());
	        $info = $role->allowField(true)->save();
            if($info) return $this->success('添加成功', '/role');

	    }
        return view('create');
    }
    /*
    * 编辑角色
    */
    public function edit()
    {
        $id = $this->request->param('id');
        $role = $this->role->getRole($id);

        if($this->request->param('do') === 'edit'){

	        $info = $this->role->allowField(['desc','listorder','disable'])->save($this->request->param(),['roleid' => 
	        	$id]);
	        $this->success('修改成功', '/role');
        }
        
        return view('edit', ['role' => $role]);
    }
    /*
    * 删除角色
    */
    public function delete()
    {
        if($this->request->isAjax()){
            $id = $this->request->param('id');
	        $info = RoleModel::destroy($id);
	        return ['status' => 'success', 'msg' => $info];
        }
    }
}
?>