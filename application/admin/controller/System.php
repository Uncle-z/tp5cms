<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\System as SystemModel;

/**
*author: uncle;
*time: 2020-01-12;
*/

class System extends Admin
{

    function __construct(SystemModel $system)
    {
        parent::__construct();
        $this->system = $system;
    }
    public function index()
    {
        $params = '';
    	return view('index', ['params' => $params]);
    }
}
?>