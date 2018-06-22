<?php
	session_start();

	$exception =  array('register', 'login');
	// $page = substr(end(explode('/',$_SERVER['SCRIPT_NAME'])), 0, -4);

	// if(in_array($page, $exception) === false){
	// 	if(isset($_SESSION['username']) === false){
	// 		header('Location: login.php');
	// 		die();
	// 	}
	// }
	$conn = mysqli_connect('127.0.0.1','root','root','Lex') or die("Failed to query database");

	$path = dirname(__FILE__);

	include($path."/inc/user.inc.php");

?>
