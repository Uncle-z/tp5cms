<?php

namespace app\admin\controller;

use app\admin\controller\Admin;
use app\admin\model\Category as CategoryModel;
use app\admin\model\Module as ModuleModel;
use BlueM\Tree;

class Category extends Admin
{
    private $category;
    private $module;
    function __construct(CategoryModel $category,ModuleModel $module)
    {
        parent::__construct();
        $this->category = $category;
        $this->module = $module;
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $cates = $this->category->getCates('0');
        $tree = new Tree($cates, ['id' => 'cateid', 'parent' => 'parentid']);
        $nodes = $tree->getNodes();
        foreach ($nodes as &$node) {
            $node->level = $node->getLevel();
            $node->following = $node->getFollowingSibling();
            $node->hasChildren = $node->hasChildren();
            $parentNode = $node->getParent();
            $parentFlowing = $parentNode->parent ? $parentNode->getFollowingSibling() : null;
            $node->space = $parentFlowing ? getSpace($node->level, true) : getSpace($node->level, false);
        }
        return view('index', ['cates' => $nodes]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $parentid = $this->request->param('id') ? $this->request->param('id') : '';
        $cates = $this->category->getCates('0');
        $modules = $this->module->getModules();
        return view('create', ['cates' => $cates, 'parentid' => $parentid, 'modules' => $modules]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function addSinglePage()
    {
        $parentid = $this->request->param('id') ? $this->request->param('id') : '';
        $cates = $this->category->getCates('0');
        return view('singlePage', ['cates' => $cates, 'parentid' => $parentid]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function addOutLink()
    {
        $parentid = $this->request->param('id') ? $this->request->param('id') : '';
        $cates = $this->category->getCates('0');
        return view('outLink', ['cates' => $cates, 'parentid' => $parentid]);
    }
    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        if($this->request->isPost()){

            if($this->request->param('typeid') === 1 && !$this->request->param('moduleid')){
                $this->error('请选择栏目模型', '/category/create');
                return ;
            }

            if($this->request->param('typeid') === 2 && !$this->request->param('url')){
                $this->error('请输入外部链接地址', '/category/outLink');
                return ;
            }

            if(!is_username($this->request->param('catename/s'))){
                $this->error('栏目名称[ '. $this->request->param('catename') .' ]不符合规范，请更换', '/category/create');
                return ;
            }

            $cate = new CategoryModel($this->request->param());
            $info = $cate->allowField(true)->save();
            if($info) return $this->success('添加成功', '/category');
        }
        return view('index');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $id = $this->request->param('id');
        $cate = $this->category->getCate($id);
        $cates = $this->category->getCates('0');
        $modules = $this->module->getModules();

        if($this->request->param('do') === 'edit'){
            if($id === $this->request->param('parentid')){
                $this->error('上级菜单不能为当前修改栏目,请更换', '/category/'.$id.'/edit');
            }
            $info = $this->category->allowField(['moduleid','catename','parentid','englishdir','image','listorder','display'])->save($this->request->param(),['cateid' => $id]);
            $this->success('修改成功', '/category');
        }

        return view('edit', ['cate' => $cate, 'cates' => $cates, 'modules' => $modules]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update($id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
