<?php
namespace app\admin\controller;
use app\admin\controller\Admin;

/**
*author: uncle;
*time: 2020-01-12;
*/

class System extends Admin
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
    	return '系统参数设定';
    }
}
?>