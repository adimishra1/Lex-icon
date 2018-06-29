<?php
	session_start();
	include("/var/www/html/cred.inc.php");


	$exception =  array('register', 'login');

	$conn = mysqli_connect('127.0.0.1',$my_username,$my_password,$my_db_name) or die("Failed to query database".mysqli_error());
	$path = dirname(__FILE__);

	include($path."/inc/user.inc.php");

?>
