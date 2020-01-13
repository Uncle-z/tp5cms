<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\Menu as MenuModel;

class Menu extends Admin
{
    private $menu;
    function __construct(MenuModel $menu)
    {
        parent::__construct();
        $this->menu = $menu;
    }
    /*
    * 获取所有菜单
    */
	public function index()
    {
        if($this->request->isAjax()){
            return $this->menu->asyncGetMenus($this->request->param('page'), $this->request->param('limit'));
        }
        return view('index');
    }

    public function create()
    {
        $parentid = $this->request->param('id') ? $this->request->param('id') : '';
        $menus = $this->menu->getMenus();
    	return view('create', ['menus' => $menus, 'parentid' => $parentid]);
    }
    /*
    * 保存菜单
    */
    public function save()
    {
        if($this->request->isPost()){
            if(!is_username($this->request->param('menuname/s'))){
                $this->error('菜单名称[ '. $this->request->param('menuname') .' ]不符合规范，请更换', '/menu/create');
                return ;
            }

            $menu = new MenuModel($this->request->param());
            $info = $menu->allowField(true)->save();
            if($info) return $this->success('添加成功', '/menu');

        }
        return view('create');
    }
    /*
    * 编辑菜单
    */
    public function edit()
    {
        $id = $this->request->param('id');
        $menu = $this->menu->getMenu($id);
        $menus = $this->menu->getMenus();

        if($this->request->param('do') === 'edit'){

            $info = $this->menu->allowField(['menuname','menuicon','route','parentid','listorder','display'])->save($this->request->param(),['menuid' => $id]);
            $this->success('修改成功', '/menu');
        }
        
        return view('edit', ['menu' => $menu, 'menus' => $menus]);
    }
    /*
    * 删除菜单
    */
    public function delete()
    {
        if($this->request->isAjax()){
            $id = $this->request->param('id');
            $info = MenuModel::destroy($id);
            return ['status' => 'success', 'msg' => $info];
        }
    }

}
?>