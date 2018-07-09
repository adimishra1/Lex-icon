<?php
	include("cred.inc.php");
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
	$password = mysqli_real_escape_string($conn,htmlentities($password));
	//$password = sha1($password);

	$query = "SELECT * FROM users WHERE username='".$username."' AND password ='".$password."'";
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

//adds a user to the database.
function add_user($conn,$name,$email,$username,$password,$image){
	$username = mysqli_real_escape_string($conn,htmlentities($username));
	$email = mysqli_real_escape_string($conn,htmlentities($email));
	$password = mysqli_real_escape_string($conn,htmlentities($password));
	//$password = sha1($password);
	$bool = mysqli_query($conn,"INSERT INTO `users` (`name`, `email`, `username`, `password`, `images`) VALUES ('".$name."','".$email."','".$username."','".$password."','".$image."')") or die(mysqli_error($conn));

	return $bool;
}

//check if the word exist in trending
function word_exists($conn,$word){
	$user =mysqli_real_escape_string($conn,htmlentities($word));

	$query = "SELECT * FROM trending WHERE word='".$word."'";

	$result1 = mysqli_query($conn,$query) or die (mysqli_error($conn).$query);
	$count = mysqli_num_rows($result1);

	if ($count>0) {
		//echo 'Sorry! This word already exists!';
		return true;
	} else {
		//echo "word dosent exist";
		return false;
	}

}
?>
