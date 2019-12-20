<?php
namespace app\admin\controller;

class Index
{
    public function index()
    {
        return view('main/home');
    }
    public function pageIndex()
    {
        return view('pageindex');
    }
}
