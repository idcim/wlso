<?php
include './../inc/comm.php';
$w = new wonyun;

include WONINC . '/order.class.php';
$o = new order;

if ($w -> check() == '0') {
	$w -> msg('还没有登录呢!错误代码:107', '/admin.php');
}
$config['name'] = $_SESSION['name'];
$config['user'] = $_SESSION['user'];


if ($g) {
	if ($g['ac'] == 'logout') {
		//登出
		$w -> logout();
	}elseif($g['ac'] == 'edit'){
		//编辑
		$config['aid']=$g['aid'];
		
		$odate=$o->show($g['aid']);
		$o->edit($odate);
		
	}elseif($g['ac']=='add'){
		//添加数据
		$w -> show('add');
		exit();
	}elseif($g['ac']=='del'){
		$o->del($g['aid']);
	}
}

if($p){
	if($p['ac']=='update'){
		$o->update($p);
	}elseif($p['ac']=='add'){
		$o->adds($p);
	}
}

$config['oli'] = $o -> li('0', '10');

$w -> show('list');
?>
