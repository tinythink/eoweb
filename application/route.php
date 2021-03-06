<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    '/list/:type' => 'index/index/type',
    '/upload' => 'admin/foods/upload',
    '/product/[:id]' => 'index/index/product',
    '/about' => 'index/index/about',
    '/concat' => 'index/index/concat',
    '/find' => 'index/index/find',

    '/user/login' => 'admin/user/index',
    '/user/doLogin' => 'admin/user/do_login',
    '/user/logout' => 'admin/user/logout',
    '/user/find' => 'admin/user/find_user',

    '/admin/type' => 'admin/types/index',
    '/type/add' => 'admin/types/add',
    '/type/del' => 'admin/types/del',
    '/type/find' => 'admin/types/find',
    '/type/update' => 'admin/types/update',

    '/admin/food' => 'admin/foods/index',
    '/food/add' => 'admin/foods/add',
    '/food/del' => 'admin/foods/del',
    '/food/find' => 'admin/foods/find',
    '/food/update' => 'admin/foods/update',

    '/admin/news' => 'admin/news/index',
    '/news/add' => 'admin/news/add',
    '/news/doAdd' => 'admin/news/doAdd',
    '/news/edit' => 'admin/news/edit',

    '/news/del' => 'admin/news/del',
    '/news/find' => 'admin/news/find',
    '/news/update' => 'admin/news/update'
];
