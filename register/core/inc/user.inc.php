<?php
	$conn = mysqli_connect('127.0.0.1','root','root','Lex') or die("Failed to query database".mysqli_error());

//check if the username exists in the database.
function user_exists($conn,$username){
	$user =mysqli_real_escape_string($conn,$username);

	$query = "SELECT * FROM users WHERE username='".$username."'";

	$result1 = mysqli_query($conn,$query) or die (mysqli_error($conn).$query);
	$count = mysqli_num_rows($result1);

	if ($count>0) {
		//echo 'Sorry! This Username already exists!';
		return true;
	} else {
		//echo "username dosent exist";
		return false;
	}

}

//check if the given username and password combination is valid.
function  valid_credentials($conn,$username,$password){
	$username = mysqli_real_escape_string($conn,htmlentities($username));
	//$password = sha1($password);

	$total = mysqli_query($conn,"SELECT COUNT(`id`) FROM `users` WHERE `username` = '{$username}' AND `password` = '{$password}'") or die(mysqli_error($conn));
	return (mysqli_result($conn,$total , 0) == '1') ?  true : false;
}

//adds a user to the database.
function add_user($conn,$name,$email,$username,$password,$image){
	$username = mysqli_real_escape_string($conn,htmlentities($username));
	$email = mysqli_real_escape_string($conn,htmlentities($email));
	//$password = sha1($password);
	$bool = mysqli_query($conn,"INSERT INTO `users` (`name`, `email`, `username`, `password`, `images`) VALUES ('".$name."','".$email."','".$username."','".$password."','".$image."')") or die(mysqli_error($conn));

	return $bool;
}

?>
