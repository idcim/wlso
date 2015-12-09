<?php
session_start();
$config=array(
	'host'=>'localhost:3306',
	'dbuser'=>'root',
	'dbpass'=>'123456',
	'dbport'=>'3306',
	'dbname'=>'wlcha',
	'skin'=>'won',
	'webtitle'=>'物流查询系统'
);

/*
 * 错误代码:
 * 100:内容为空
 * 104:用户名错误
 * 105:密码错误
 * 107:用户未登录
 * */