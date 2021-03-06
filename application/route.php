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

use think\Route;


// 首页
Route::rule('admin/index',                 'admin/Index/index');
Route::rule('admin/index/console',         'admin/Index/console');


// 登录
Route::rule('admin/login',                 'admin/Login/index');
Route::rule('admin/login/captcha',         'admin/Login/captcha');
Route::rule('admin/login/loginact',        'admin/Login/loginAct');
Route::rule('admin/login/logoutact',       'admin/Login/logoutAct');


// 用户管理
Route::rule('admin/user/agent',            'admin/User/agent');
Route::rule('admin/user/agentlist',        'admin/User/agentList');

Route::rule('admin/user/userupdate',       'admin/User/userUpdate');
Route::rule('admin/user/userdelete',       'admin/User/userDelete');
Route::rule('admin/user/onlinestatus',     'admin/User/onlineStatus');
Route::rule('admin/user/forbiddenstatus',  'admin/User/forbiddenStatus');
Route::rule('admin/user/channelrate',      'admin/User/channelRate');

Route::rule('admin/user/channelquery',      'admin/User/channelQuery');
Route::rule('admin/user/agentquery',        'admin/User/agentQuery');
Route::rule('admin/user/merchantquery',     'admin/User/merchantQuery');

Route::rule('admin/user/merchant',          'admin/User/merchant');
Route::rule('admin/user/merchantlist',      'admin/User/merchantList');


// 订单管理
Route::rule('admin/pay',                    'admin/Pay/index');
Route::rule('admin/pay/query',              'admin/Pay/query');
Route::rule('admin/pay/notify',             'admin/Pay/notify');

Route::rule('admin/pay/skma',               'admin/Pay/skma');
Route::rule('admin/pay/skmalist',           'admin/Pay/skmaList');
Route::rule('admin/pay/skmaupdate',         'admin/pay/skmaUpdate');
Route::rule('admin/pay/skmadelete',         'admin/pay/skmaDelete');
Route::rule('admin/pay/skmaonline',         'admin/pay/skmaOnline');
Route::rule('admin/pay/skmatest',           'admin/pay/skmaTest');

Route::rule('admin/pay/xianyu',             'admin/Pay/xianyu');
Route::rule('admin/pay/xianyulist',         'admin/Pay/xianyuList');

Route::rule('admin/pay/order',              'admin/Pay/order');
Route::rule('admin/pay/orderlist',          'admin/Pay/orderList');


// 资金管理
Route::rule('admin/finance/user',           'admin/Finance/user');
Route::rule('admin/finance/userlist',       'admin/Finance/userList');
Route::rule('admin/finance/userrecharge',   'admin/Finance/userRecharge');

Route::rule('admin/finance/account',        'admin/Finance/account');
Route::rule('admin/finance/overview',       'admin/Finance/overview');
Route::rule('admin/finance/detail',         'admin/Finance/detail');
Route::rule('admin/finance/withdrawal',     'admin/Finance/withdrawal');

Route::rule('admin/finance/card',           'admin/Finance/card');
Route::rule('admin/finance/cardlist',       'admin/Finance/cardList');
Route::rule('admin/finance/cardadd',        'admin/Finance/cardAdd');
Route::rule('admin/finance/cardupdate',     'admin/Finance/cardUpdate');
Route::rule('admin/finance/carddelete',     'admin/Finance/cardDelete');

Route::rule('admin/finance/cashlog',        'admin/Finance/cashlog');
Route::rule('admin/finance/cashloglist',    'admin/Finance/cashlogList');
Route::rule('admin/finance/cashlogrollback','admin/Finance/cashlogRollback');
Route::rule('admin/finance/cashlogpass',    'admin/Finance/cashlogPass');
Route::rule('admin/finance/cashlogdeny',    'admin/Finance/cashlogDeny');


//系统配置
Route::rule('admin/sys/userinfo',           'admin/Sys/userinfo');
Route::rule('admin/sys/password',           'admin/Sys/password');
Route::rule('admin/sys/userupdate',         'admin/Sys/userUpdate');

