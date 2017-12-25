<?php
return array(

'TMPL_PARSE_STRING' => array(

'__VENDOR__' => __ROOT__ . '/Public/vendor', // 配置自定义资源文件夹：第三方库
'__ADIST__' => __ROOT__ . '/Public/Admin/dist', // 配置自定义资源文件夹：admin业务代码
'__HDIST__' => __ROOT__ . '/Public/Home/dist', // 配置自定义资源文件夹：home业务代码
'__DIST__' => __ROOT__ . '/Public/dist', // 配置自定义资源文件夹：全局业务代码
'__ASSETS__' => __ROOT__ . '/Public/assets', // 配置自定义资源文件夹：资源文件夹
'__PUBLIC__' => __ROOT__ . '/Public', // 配置自定义资源文件夹
'__APPNAME__' => '未配置app_name！', // 配置自定义资源文件夹

),

/* 数据库设置 */
'DB_TYPE' => 'mysql', // 数据库类型
'DB_HOST' => '127.0.0.1', // 服务器地址
'DB_NAME' => 'yan', // 数据库名
'DB_USER' => 'root', // 用户名
'DB_PWD' => 'mysqlyh12138..', // 密码
'DB_PORT' => '3306', // 端口
'DB_PREFIX' => 'y_', // 数据库表前缀

'TMPL_ACTION_ERROR' =>'./tpl/jump.html',
'TMPL_ACTION_SUCCESS' =>'./tpl/jump.html'
);