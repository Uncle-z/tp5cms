<?php
namespace app\admin\controller;
use app\admin\controller\Admin;

class Menu extends Admin
{
	public function index()
    {
        return view('index');
    }

    public function add()
    {
    	return view('add');
    }



}
?>