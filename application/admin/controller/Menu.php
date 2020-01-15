<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\Menu as MenuModel;
use BlueM\Tree;

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
        $menus = $this->menu->getMenus('0');
        $tree = new Tree($menus, ['id' => 'menuid', 'parent' => 'parentid']);
        $nodes = $tree->getNodes();
        foreach ($nodes as &$node) {
            $node->level = $node->getLevel();
            $node->following = $node->getFollowingSibling();
            $parentNode = $node->getParent();
            $parentFlowing = $parentNode->parent ? $parentNode->getFollowingSibling() : null;
            $node->space = $parentFlowing ? getSpace($node->level, true) : getSpace($node->level, false);
        }
        return view('index', ['menus' => $nodes]);
    }

    public function create()
    {
        $parentid = $this->request->param('id') ? $this->request->param('id') : '';
        $menus = $this->menu->getMenus('0');
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
        $menus = $this->menu->getMenus($id);

        if($this->request->param('do') === 'edit'){
            if($id === $this->request->param('parentid')){
                $this->error('上级菜单不能为当前修改栏目,请更换', '/menu/'.$id.'/edit');
            }
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