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
        //
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
        //
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
