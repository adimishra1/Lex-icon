<?php
	session_start();
	include("/var/www/html/Lex-icon/cred.inc.php");

	$exception =  array('register', 'login');

	$path = dirname(__FILE__);

	include($path."/inc/user.inc.php");

?>
