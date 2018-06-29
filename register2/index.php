<?php

include('core/init.inc.php');

if(isset($_POST['submit'])){

	$errors = array();
	if(empty($_POST['username'])){
		$errors[] = 'The username cannot be empty.';
	}
	if(empty($_POST['name'])){
		$errors[] = 'The name cannot be empty.';
	}
	if(empty($_POST['password']) || empty($_POST['repeat_password'])){
		$errors[] = 'The password cannot be empty.';
	}
	if($_POST['password'] !== $_POST['repeat_password']){
		$errors[] = 'Password verification failed.';
	}
	if(user_exists($conn,$_POST['username'])){
		$errors[] = 'The username you entered is already taken.';
	}
	if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])){
	  	$errors[] = "Only letters and white space allowed"; 
	}
	if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
  		$errors[] = "Invalid email format"; 
	}
    if(!($_FILES['file']['error'] === UPLOAD_ERR_OK)){
        $errors[] = 'Please select an Image';
   	}
    if(empty($errors)){
   		$name = $_FILES['file']['name'];
   		$target_dir = "upload/";
   		$target_file = $target_dir . basename($_FILES["file"]["name"]);

   		// Select file type
   		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   		// Valid file extensions
	    $extensions_arr = array("jpg","jpeg","png","gif");
   		// Check extension
   		if( in_array($imageFileType,$extensions_arr) ){
    		// Convert to base64
    		//either of the image variable can be used.
   			//$image = addslashes(file_get_contents($_FILES['file']['tmp_name']));

    		$image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
    		$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
	    	// Insert record
		    $bool = add_user($conn,$_POST['name'],$_POST['email'],$_POST['username'],$_POST['password'],$image);
	    	//upload
	    	move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$_POST['username']);
	    	if(!$bool){
	    		echo "Failed to Insert";
	    	}else{
	    		$_SESSION['username'] = htmlentities($_POST['username']);
    			header("location: ../MainPage/index.php");
    			exit;
    		}
    	}
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lex-icon</title>
		<link rel="stylesheet" type="text/css" href="css/base.css" />
		<script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");</script>
	</head>
	<body class="demo-1 loading">
		<main>
			<div class="content content--side">
				<header class="codrops-header">
					<h1 class="codrops-header__title">LEX-ICON SIGNUP</h1>
				</header>
				<form class="form" action="index.php" method="POST" enctype='multipart/form-data'>
					<div class="form__item">
						<label class="form__label" for="name">Full Name</label>
						<input class="form__input" type="text" name="name" id="name">
					</div>
					<div class="form__item">
						<label class="form__label" for="email">Email Address</label>
						<input class="form__input" type="email" name="email" id="email">
					</div>
					<div class="form__item">
						<label class="form__label" for="username">Username</label>
						<input class="form__input" type="username" name="username" id="username">
					</div>
					<div class="form__item">
						<label class="form__label" for="password">Password</label>
						<div class="form__input-wrap">
							<input class="form__input" type="password" name="password" id="password">
							<p class="form__password-strength" id="strength-output"></p>
							<br><br>
						</div>
					</div>
					<div class="form__item">
						<label class="form__label" for="repeat_password">Repeat Password</label>
						<div class="form__input-wrap">
							<input class="form__input" type="password" name="repeat_password" id="password">
						</div>
					</div>
					<div class="form__item">
						<img id="blah" src="#" onerror="this.src='img/default.jpg'" style="height: 7em; width: 5em;" />
						<input type='file' name="file" />
					</div>
					<div class="form__item form__item--actions">
						<span>Already have an account? <a class="form__link" href="#">Login here</a></span>
						<input class="form__button" type="submit" name="submit" value="Signup">
					</div>
				</form>
			</div>
			<div class="content content--side">
				<div class="poster" style="background-image:url(img/1.jpg)"></div>
				<div class="canvas-wrap">
					<canvas></canvas>
				</div>
			</div>
		</main>
		<script src="js/imagesloaded.pkgd.min.js"></script>
		<script src="js/zxcvbn.js"></script>
		<script src="js/demo1.js"></script>
	</body>
</html>
