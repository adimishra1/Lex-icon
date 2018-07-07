<?php
	session_start();

	//$exception =  array('register', 'login');
	// $path = dirname(__FILE__);
	include("inc/cred.inc.php");
	if(!isset($_SESSION['username'])){
		header("location: ../index.html");
		exit;
	}


	$username = $_SESSION['username'];

	$query = "SELECT * FROM users WHERE username='".$username."'";
	$result1 = mysqli_query($conn,$query) or die (mysqli_error($conn).$query);
	$user = mysqli_fetch_array($result1);
	$user_id = $user['id'];
	$user_name = $user['name'];
	$user_email = $user['email'];
	$user_image = $user['images'];
	/* <img src='<?php echo $image_src; ?> >                For inserting image.*/

	include("inc/user.inc.php");

?>
