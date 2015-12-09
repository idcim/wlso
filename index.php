<?php

include 'inc/comm.php';

$w = new wonyun;
if($p['ac']=='so'){
	$w->so($p['kw']);
}


if($g['passwd']=="8110"){
	if($p['ac']=='pas'){
		$w->msg($w->passwd($p['password']),'/?passwd=8110');
	}
	$w->show('passwd');
	exit();
}

$w -> show('index');

?>