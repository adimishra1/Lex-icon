<?php 

include('core/init.inc.php'); 

if(isset($_POST['submit'])){
	

	$errors = array();
	if(empty($_POST['username'])){
		$errors[] = 'The username cannot be empty.';
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

    if(empty($errors)){
    	echo "First level passed";
        $file =$_FILES['pic']['tmp_name'];
    	if(!isset($file))
    	{
    	    echo 'Please select an Image';
    	}

   		$name = $_FILES['pic']['name'];
   		$target_dir = "upload/";
   		$target_file = $target_dir . basename($_FILES["pic"]["name"]);

   		// Select file type
   		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
   		// Valid file extensions
	    $extensions_arr = array("jpg","jpeg","png","gif");

   		// Check extension
   		if( in_array($imageFileType,$extensions_arr) ){
   			echo "seceond Level passed";
    		// Convert to base64 
    		//either of the image variable can be used.		
   			$image = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
   	
    		$image_base64 = base64_encode(file_get_contents($_FILES['pic']['tmp_name']) );
    		$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
	    	// Insert record
		    $bool = add_user($conn,$_POST['name'],$_POST['email'],$_POST['username'],$_POST['password'],$image);    		
	
		    echo "third level passed";
	    	//upload
	    	move_uploaded_file($_FILES['pic']['tmp_name'],$target_dir.$name);

	    	$_SESSION['username'] = htmlentities($_POST['username']);
	    	if(!$bool){
	    		echo "Failed to Insert";
	    	}else{
    			header("location: Lex-icon/index.html");
    			exit;
    		}
    	}

    }

}

?>



<!DOCTYPE HTML>
<html>



<head>


<title>Lex-icon SignUp</title>

<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Trendy Signup Form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->

<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->

<!--Google Fonts-->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>

</head>



<body>


<div class="wthree-dot">

	<h1>Lex-icon SignUp</h1>
	<div class="profile">
		<div class="wrap">
			<div class="wthree-grids">
				<div class="content-left">
					<div class="content-info">
						<h2>Who We Are?</h2>
						<div class="slider">
							<div class="callbacks_container">
								<ul class="rslides callbacks callbacks1" id="slider4">
									<li>
										<div class="w3layouts-banner-info">
											<h3>Vivamus dui dolor</h3>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et placerat leo, non condimentum justo</p>
										</div>
									</li>
									<li>
										<div class="w3layouts-banner-info">
											<h3>Duis in nisl egestas</h3>
											<p>Suspendisse leo lacus, hendrerit consectetur scelerisque in, tempor sit amet tortor. Pellentesque rhoncus</p>
										</div>
									</li>
								</ul>
							</div>
							<div class="clear"> </div>
						</div>
						<div class="agileinfo-follow">
							<h4>Sign Up with</h4>
						</div>
						<div class="agileinfo-social-grids">
							<ul>
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-rss"></i></a>
								<a href="#"><i class="fa fa-vk"></i></a>
								<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
								<a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
							</ul>
						</div>
						<div class="agile-signin">
							<h4>Already have an account <a href="#">Sign In</a></h4>
						</div>
					</div>
				</div>
				<div class="content-main">
					<div class="w3ls-subscribe">
						<h4>Just Visited?</h4>
						<form action="index.php" method="post" enctype='multipart/form-data'>
							<input type="text" name="name" placeholder="Name" required="">
							<input type="text" name="username" placeholder="Username" required="" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>">
							<input type="email" name="email" placeholder="Email" required="">
							<input type="password" name="password" placeholder="Password" required="">
							<input type="password" name="repeat_password" placeholder="Confirm Password" required="">
							<input type="file" name="pic" id="pic">
							<input type="submit" name ="submit" value="Sign Up">
						</form>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="wthree_footer_copy">
				<p>© 2018 Lex-icon Signup Form. All rights reserved | Design by Lex-icon</a></p>
			</div>
		</div>
	</div>

</div>

<script src="js/responsiveslides.min.js"></script>
									<script>
										// You can also use "$(window).load(function() {"
										$(function () {
										  // Slideshow 4
										  $("#slider4").responsiveSlides({
											auto: true,
											pager:true,
											nav:false,
											speed: 400,
											namespace: "callbacks",
											before: function () {
											  $('.events').append("<li>before event fired.</li>");
											},
											after: function () {
											  $('.events').append("<li>after event fired.</li>");
											}
										  });

										});
	                </script>
									<!--banner Slider starts Here-->


</body>



</html>
