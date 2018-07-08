<?php
include("core/init.inc.php");

$errors = array();

if(isset($_POST['submit'])){
  if(empty($_POST['username'])){
    $errors[] = 'The username cannot be empty.';
  }
  if(empty($_POST['password'])){
    $errors[] = 'The password cannot be empty.';
  }
  if(valid_credentials($conn,$_POST['username'],$_POST['password']) === false){
    $errors[] = 'Username / Password incorrect.';
    header('location: index.php#popup1');
    exit;
  }
  if(empty($errors)){
    $_SESSION['username']=htmlentities($_POST['username']);
    header('location: ../mainpage/index.php');
    exit;
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <link rel='shortcut icon' type='image/gif' href='images/Lex.gif'/>
  <meta name="description" content="A webapp that improves vocabulary skills" />
  <meta name="keywords" content="english, words, vocabulary, learn, language, social, login" />
  <meta name="author" content="Lex-icon" />

  <style>

  $text: #fff;
  $link: #e34234;
  $link-hover: #ba160c;

  canvas {
    display: block;
    vertical-align: bottom;
  }

  #particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url('images/img1.jpg');
    height: 100vh;
  }

  .text {
  	position: absolute;
    top:50%;
    right:50%;
  	transform: translate(50%,-50%);
  	color: $text;
  	max-width: 90%;
  	padding: 2em 3em;
  	background: rgba(0, 0, 0, 0.0);
  	text-shadow: 0px 0px 2px #131415;
  	font-family: 'Open Sans', sans-serif;

  }

  h1 {
  	font-size: 2.25em;
  	font-weight: 700;
  	letter-spacing: -1px;
  }

  a,
  a:visited {
  	color: $link;
  	transition: 0.25s;
  }

  a:hover,
  a:focus {
  	color: $link-hover;
  }
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css/util.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!--===============================================================================================-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>

<!-- count particles -->

<!-- particles.js container -->
<div id="particles-js"></div>



<div class="text">
<!-- to be inserted here-->
<!-- <div class="container-login100"> -->
  <div class="wrap-login100">
    <a href="../index1.html">
      <img src="images/logo2.png" alt="AVATAR" title="Click here to go back to home page" style="height:30vh; width:65vh; padding-right:10em; top:-2em; padding-bottom:2em;"></a>
    <form class="login100-form validate-form" method="POST" action="index.php" align="center">
      <!-- <div class="login100-form-avatar">
        <img src="images/logo.png" alt="AVATAR">
      </div> -->

      <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
        <input class="input100" type="text" name="username" placeholder="Username">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
          <i class="fa fa-user"></i>
        </span>
      </div>

      <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
        <input class="input100" type="password" name="password" placeholder="Password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
          <i class="fa fa-lock"></i>
        </span>
      </div>
      <div class="container-login100-form-btn p-t-10">
        <button class="login100-form-btn" type="submit" name="submit">
          Login
        </button>
      </div>
      <div class="text-center w-full p-t-25 ">
        <a href="#popup2" class="txt1">
          Forgot Username / Password?
        </a><br>
        <a class="txt1" href="../register2/index.php">
          Create new account
          <i class="fa fa-long-arrow-right"></i>
        </a>
        <a class="txt1" href="../index1.html">
          <br />
          <i class="fa fa-long-arrow-left"></i>
          Go back to home page

        </a>
      </div>

      <!-- <div class="text-center w-full">
        <a class="txt1" href="#">
          Create new account
          <i class="fa fa-long-arrow-right"></i>
        </a>
      </div> -->
    </form>
  </div>
<!-- </div> -->
</div>
<div id="popup1" class="overlay">
  <div class="popup">
    <p style="color:red; text-align:center;">USERNAME/PASSWORD INCORRECT</p>
    <a class="close" href="#">&times;</a>
    <!-- <div class="contentA">
      <p>Close box to try again...</p>
    </div> -->
  </div>
</div>
<div id="popup2" class="overlay">

  <div class="form-gap"></div>
    <div class="container" style="margin-left:28%;">
	     <div class="row" style="width:800px;">
		       <div >
            <div class="panel panel-default">
              <a class="close" href="#" style="padding-right: 10px; padding-top: 10px;">&times;</a>
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">

                    <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="core/email.php">

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>

                      <input type="hidden" class="hide" name="token" id="token" value="">
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
	       </div>
      </div>
</div>
</div>
<div id="popup3" class="overlay">
  <div class="popup">
    <p style="color:red; text-align:center;">MAIL SENT</p>
    <a class="close" href="#">&times;</a>
    <div class="contentA">
      <p>A mail have been sent to your email address regarding the  username and password.Its a system generated mail pleases do not reply.</p>
    </div>
  </div>
</div>
<div id="popup4" class="overlay">
  <div class="popup">
    <p style="color:red; text-align:center;">NETWORK ERROR</p>
    <a class="close" href="#">&times;</a>
    <div class="contentA">
      <p>There was either problem connecting to the server due to slow internet or any other error.</p>
    </div>
  </div>
</div>
<div id="popup5" class="overlay">
  <div class="popup">
    <p style="color:red; text-align:center;">MAIL NOT SENT</p>
    <a class="close" href="#">&times;</a>
    <div class="contentA">
      <p>The email address you entered was incorrect please recheck the email Address or register using the new email address.</p>
    </div>
  </div>
</div>
<style>
.form-gap {
    padding-top: 70px;
}
.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: #000;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}


.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 90px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup p {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #f00;
}
.close:hover{
  color: #f00 ;
  transition: 0.25s;
}
.popup .contentA {
  max-height: 600px;
  overflow: auto;
	width: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>


<!-- scripts -->

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	 <script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
  <script src="js/main.js"></script>
<script src="js/particles.js"></script>
<script src="js/app.js"></script>


</body>
</html>
