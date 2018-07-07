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

</head>
<body>

<!-- count particles -->

<!-- particles.js container -->
<div id="particles-js"></div>



<div class="text">
<!-- to be inserted here-->
<?php
 if(empty($errors)===false){
        foreach($errors as $error){
          echo "<script>alert('Username or Password Incorrect');</script>";
        }
      }
  ?>
<!-- <div class="container-login100"> -->
  <div class="wrap-login100">
      <img src="images/logo.png" alt="AVATAR" style="height:80%; width:160%; padding-right:10em; top:-2em; padding-bottom:2em;">
    <form class="login100-form validate-form" method="POST" action="index.php">
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
        <a href="#" class="txt1">
          Forgot Username / Password?
        </a><br>
        <a class="txt1" href="../register2/index.php">
          Create new account
          <i class="fa fa-long-arrow-right"></i>
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
