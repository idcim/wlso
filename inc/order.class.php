<?php
class order {
	//列出数据
	function li($pagestar, $pageend) {
		global $w;
		$w -> contdb();
		if (empty($pagestar)) {
			$pagestar = 0;
			$pageend = 10;
		}
		$sql = "SELECT * FROM `wy_order` WHERE state='1'  ORDER BY `creattime` DESC LIMIT {$pagestar}, {$pageend}";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$li[]=$row;
		}
		mysql_close();
		
		return $li;
	}
	
	//显示单条数据
	function show($aid) {
		global $w;
		$w -> contdb();
		
		$sql="SELECT * FROM `wy_order` WHERE aid='{$aid}' LIMIT 1";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	//编辑订单
	function edit($data){
		global $w;
		$w -> show('edit',$data);
		exit();
	}
	

	//添加数据
	function adds($data) {
		global $w;
		
		if(empty($data['editorValue']) or empty($data['title'])){
			$w->msg('数据输入不能为空', '/_gl/index.php?ac=add');
		}

		$w -> contdb();
		$data['crtime']=time();
		$sql="INSERT INTO `wy_order` (`title`, `content`, `creattime`, `uid`) VALUES ('{$data['title']}', '{$data['editorValue']}', '{$data['crtime']}', '{$_SESSION['uid']}')";
		$q=mysql_query($sql);
		if($q){
			$w->msg("恭喜您，数据已经添加成功！", '/_gl/index.php');
		}else{
			$w->msg("Oop!数据添加出错，请重新操作！", '/_gl/index.php?ac=add');
		}
	}

	//删除数据
	function del($aid) {
		global $w;
		$w -> contdb();
		$sql="SELECT * FROM `wy_order` WHERE `aid`='{$aid}' LIMIT 1";
		$quser=mysql_query($sql);
		$row=mysql_fetch_array($quser);
		if($row['uid'] != $_SESSION['uid']){
			$w->msg("这条数据不属于您，您请回吧！");
		}
		$sql="UPDATE `wy_order` SET `state`='2' WHERE (`aid`='{$aid}')";
		$del=mysql_query($sql);
		if($del){
			$w->msg("恭喜您，数据已经删除成功！", '/_gl/index.php');
		}else{
			$w->msg("完了！数据删除打败，快找管理员处理！", '/_gl/index.php');
		}
		
	}

	//更新数据
	function update($data) {
		global $w;
		$w -> contdb();
		$data['uptime']=time();
		$sql="UPDATE `wy_order` SET `content`='{$data['editorValue']}', `edittime`='{$data['uptime']}' WHERE (`aid`='{$data['aid']}')";
		mysql_query($sql);
		$w->close();
	}

}
?>