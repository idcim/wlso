<?php
define('WONINC', str_replace("\\", '/', dirname(__FILE__)));
define('WONROOT', str_replace("\\", '/', substr(WONINC, 0, -3)));
define('WONSKIN', WONROOT . 'skin/');

require (WONROOT . 'config.inc.php');
$g = $_GET;
$p = $_POST;
class wonyun {
	//连接数据库
	function contdb() {
		global $config;
		$con = mysql_connect($config['host'].':'.$config['dbport'], $config['dbuser'], $config['dbpass']);
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db($config['dbname'], $con);
		return $con;
	}

	//关闭数据库
	function close() {
		mysql_close($this -> contdb());
	}

	//显示模板
	function show($skin, $data = '') {
		global $config;

		$path = WONSKIN . $config['skin'] . '/';
		require ($path . $skin . '.html');
	}

	//后台登录
	function login($uname, $pass) {
		if (!empty($uname) and !empty($pass)) {
			$pass = $this -> passwd($pass);
			$this -> contdb();
			$result = mysql_query("SELECT * FROM `wy_user` LIMIT 1");
			$row = mysql_fetch_array($result);
			if ($uname == $row['user']) {
				if ($pass == $row['passwd']) {
					$_SESSION['uid'] = $row['uid'];
					$_SESSION['user'] = $uname;
					$_SESSION['name'] = $row['nikname'];
					$_SESSION['date'] = time();
					setcookie("user", $uname, time() + 3600 * 24);
					setcookie("date", $_SESSION['date'], time() + 3600 * 24);

					//记录登录信息
					mysql_query("UPDATE `wy_user` SET ` logintime`='{$_SESSION['date']}', ` loginsut`='1' WHERE (`uid`='{$row[uid]}')");
					mysql_close();

					//重定向浏览器
					header("Location: /_gl/");
				} else {
					$this -> msg('用户信息不正确!错误代码:105', '/admin.php');
				}
			} else {
				$this -> msg('用户信息不正确!错误代码:104', '/admin.php');
			}
		} else {
			$this -> msg('用户信息不正确!错误代码:100', '/admin.php');
		}
	}

	//退出登录
	function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['name']);
		unset($_SESSION['uid']);
		setcookie("user", '', time() + 3600 * 24);
		setcookie("date", '', time() + 3600 * 24);

		$this -> msg('您已经成功退出啦!', '/admin.php');
	}

	//检测是否已经登录并操作
	function check() {
		if (!empty($_COOKIE['user']) and !empty($_SESSION['user']) and !empty($_COOKIE['date']) and !empty($_SESSION['date'])) {
			if ($_COOKIE['user'] == $_SESSION['user'] and $_COOKIE['date'] == $_SESSION['date']) {
				$v = TRUE;
			} else {
				$v = FALSE;
			}
		} else {
			$v = FALSE;
		}

		return $v;
	}

	//前台查询
	function so($kw) {
		if (!empty($kw)) {
			$this -> contdb();

			$sql = "SELECT * FROM `wy_order` WHERE title='{$kw}' LIMIT 1";
			$so = mysql_query($sql);
			$so = mysql_fetch_array($so);

			if ($so) {
				$this -> show('so',$so);
				exit();
			} else {
				$this -> msg('对不起，您所查的信息不存在！', '/');
			}
		} else {
			$this -> msg('对不起，您所查的信息不存在！', '/');
		}
	}

	//提示信息
	function msg($msg, $url = '') {
		global $config;
		if (empty($url)) {
			$url = '/';
		}
		$path = WONSKIN . $config['skin'] . '/';
		require ($path . 'msg.html');
		exit();
	}

	//MD5
	function passwd($pass) {
		$var = substr(md5($pass), -8);
		$var = substr(md5($pass), 16);
		return $var;
	}

}
?>