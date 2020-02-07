<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '__rest__'=>[
        // 指向admin模块的manage控制器
        'manage'    => 'admin/manage',
        'role'      => 'admin/role',
        'menu'      => 'admin/menu',
        'category'  => 'admin/category',
    ],
    'login'         => 'admin/index/login',
    'logout'        => 'admin/index/logout',
    'board'         => 'admin/index/board',
    'profile'       => 'admin/manage/profile',
    'editPwd'       => 'admin/manage/editPwd',
    'childMenu/:id' => 'admin/menu/create',
    'childCate/:id' => 'admin/category/create',
    'addSinglePage' => 'admin/category/addSinglePage',
    'addOutLink'    => 'admin/category/addOutLink',
    'setting'       => 'admin/system/index',
    'uploadImg'     => 'admin/upload/image',
    //'__miss__'      => 'index/error/miss',
];
