<?php
	session_start();

	//$exception =  array('register', 'login');
	
	if(!isset($_SESSION['username'])){
		header("location: ../index.html");
		exit;
	}


	$username = $_SESSION['username'];
	
	$conn = mysqli_connect('127.0.0.1','root','21522042003','Lex') or die("Failed to query database".mysqli_error());
	$query = "SELECT * FROM users WHERE username='".$username."'";
	$result1 = mysqli_query($conn,$query) or die (mysqli_error($conn).$query);
	$user = mysqli_fetch_array($result1);
	$user_id = $user['id'];
	$user_name = $user['name'];
	$user_email = $user['email'];
	/* <img src='<?php echo $image_src; ?> >                For inserting image.*/
	

	$path = dirname(__FILE__);

	include($path."/inc/user.inc.php");

?>
