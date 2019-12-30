<?php
namespace app\admin\controller;

use think\Controller;
use think\View;
//use app\admin\model\Admin;
use app\admin\model\Category;

/**
* 登陆注册
* author：uncle_z
*/
class Login extends Controller
{
    
    function __construct()
    {
        # code...
    }
    //注册
    public function register()
    {
        $request = request();      
        if($request->isPost() && $request->param('do') == 'r'){
            $info = Category::create(['name' => $request->param('username')]);
            dump($info);
            //$category->name = $request->param('username');
            //$category->save();
        }else{
            return view('register');
        }       
    }
    //登陆
    public function login()
    {
        // $info = db('admin')->where('userid',1)->find();
        // dump($info);
        //$admin = Admin::get(1);
        //dump($admin->userid);
        return view('login');
    }

    public function logout()
    {
        return view('login');
    }
}

?>