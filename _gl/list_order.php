<?php
include 'comm.php';

$w = new wonyun;

if($w->check()=='0'){
	$w->msg('还没有登录呢!错误代码:107', '/admin.php');
}



?>
