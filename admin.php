<?php
include 'inc/comm.php';

$w = new wonyun;



if($w->check()){
	header("Location: /_gl/");
}

if($_POST and $_POST['ac']=='1'){
	$w->login($_POST['uname'], $_POST['password']);
}

$w -> show('login');
?>