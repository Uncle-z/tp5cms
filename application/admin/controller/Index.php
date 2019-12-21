<?php
namespace app\admin\controller;

class Index extends Admin
{
    //后台模板
    public function index()
    {
        return view('main/home');
    }
    //后台模板首页
    public function pageIndex()
    {
        return view('pageindex');
    }

}
