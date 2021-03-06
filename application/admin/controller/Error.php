<?php
namespace app\admin\controller;
use think\Request;

/**
* 
*/
class Error
{
    public function index(Request $request)
    {
        //根据当前控制器名来判断要执行那个城市的操作
        $controllerName = $request->controller();
        return $this->tips($controllerName);
    }
    
    //注意 city方法 本身是 protected 方法
    protected function tips($name)
    {
        //和$name这个城市相关的处理
         return '当前控制器' . $name . '不存在！请检查参数是否正确';
    }
}


?>