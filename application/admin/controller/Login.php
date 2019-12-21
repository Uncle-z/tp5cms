<?php
namespace app\admin\controller;

use think\Controller;
use think\View;
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

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        return view('login');
    }
}

?>