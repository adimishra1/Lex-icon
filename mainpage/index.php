<?php
	include('core/init.inc.php');
	if(isset($_POST['submit'])){

		$word =  mysqli_real_escape_string($conn,stripcslashes($_POST['word']));
		$meaning =  mysqli_real_escape_string($conn,stripcslashes($_POST['meaning']));
		$sentence =  mysqli_real_escape_string($conn,stripcslashes($_POST['sentence']));

		$errors = array();
		if(empty($_POST['word'])){
			$errors[] = 'The word cannot be empty.';
		}
		if(empty($_POST['meaning'])){
			$errors[] = 'The meaning cannot be empty.';
		}
		if(empty($_POST['sentence'])){
			$errors[] = 'The example cannot be empty.';
		}
		if(word_exists($conn,$_POST['word'])){
			$errors[] = 'The word you entered exist in trending.';
		}
		if(empty($errors)){
			$bool = mysqli_query($conn,"INSERT INTO `trending` (`word`, `meaning`, `sentence`, `user_id`, `no_of_likes`) VALUES ('".$word."','".$meaning."','".$sentence."','".$user_id."','0')") or die(mysqli_error($conn));
			if($bool){
				$_SESSION['username'] = $username;
				header("location: index.php");
				exit;
			}else{
				echo "Failed to Insert";
			}
		}else{ 
			//error to be shown.
		}
	}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">



<head>


<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Lex-icon</title>

<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300|Quicksand:500" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<style>input:focus{
    outline: none;
}</style>



<style>
#rcorners2 {
    border-radius: 25px;
    border: 2px solid #73AD21;
    padding: 20px;
    width: 78%;
    height: 150px;
}

</style>

</head>



<body>


<div id="vs-container" class="vs-container">

	<div class="codrops-top clearfix">
		<span class="right"><a href="#section-5">About</a><a href="#section-4">Favourites</a><a href="logout.php"><span>Logout</span></a></span>
	</div>

	<header class="vs-header">
		<h1>Lex-icon </h1>
		<ul class="vs-nav">
			<li><a href="#section-1">Trending</a></li>
			<li><a href="#section-2">Word Of the Day</a></li>
			<li><a href="#section-3">Favourites</a></li>
			<!-- <li><a href="#section-4">About</a></li> -->
		</ul>
	</header>

	<div class="vs-wrapper">
		<section id="section-1">
			<div class="vs-content">
				<div class="col">
					<ul class="timeline">
						<li class="event">
							<input type="radio" name="tl-group" checked/>
							<label></label>
							<?php echo "<div class='thumb user-".$user_id."' style='background-image: url(".$user_image.");'>"; ?><span><?php echo $user_name; ?></span></div>
							<div class="content-perspective">
								<div class="content">
									<form method="post" action="index.php">
										<div class="content-inner black">
											<h3>
												<input type="text" name="word" placeholder="write your Word" style="border: none; border-color: transparent;">
											</h3>
											<p class="meaning"><input type="text" name="meaning" placeholder="Meaning" style="border: none; border-color: transparent;"></p>
										</div>
										<div class="content-inner">
											<p class="example"><input type="text" name="sentence" placeholder="example" style="border: none; border-color: transparent;"></p>
										</div>
										<input type="submit" name="submit">
										<br><br>
									</form>
								</div>
							</div>
						</li>

						<?php
						$sql = "select * from trending";
						$result=mysqli_query($conn,$sql);

						$rowcount=mysqli_num_rows($result);

						for($x=$rowcount;$x>0;$x=$x-1){
							$query=mysqli_query($conn,"select * from trending where id =$x");
							$row=mysqli_fetch_array($query);
							$word=$row['word'];
							$meaning=$row['meaning'];
							$sentence=$row['sentence'];
							$timeliner_id=$row['user_id'];

							$query2 = "SELECT name,images FROM users WHERE id='".$timeliner_id."'";
							$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn).$query2);
							$user2 = mysqli_fetch_array($result2);
							$timeliner_name = $user2['name'];
							$timeliner_image = $user2['images'];

							echo '<li class="event">
							<input type="radio" name="tl-group"/>
							<label></label>
							<div class="thumb user-'.$timeliner_id.'" style="background-image: url('.$timeliner_image.'"><span>'.$timeliner_name.'</span></div>
							<div class="content-perspective">
								<div class="content">
									<div class="content-inner black">
										<h3>'.$word.'</h3>
										<p class="meaning">'.$meaning.'</p>
										</div>
										<div class="content-inner">
											<p class="example">'.$sentence.'<br><br></p>
										</div>
									</div>
								</div>
							</li>';
						}


						 ?>


					</ul>
				</div>
			</div>
		</section>
		<section id="section-2">
			<div class="vs-content">
				<div class="col">
					<div class="wordOfTheWeak">
							<center>
								<div class="description">
									<h2>Word</h2>
									<div class="Meaning">
										<!-- <h4>Meaning</h4> -->
										<div class="para1">Meaning.</div>
									</div>

									<div class="Usage">
										<!-- <h4>Usage</h4> -->
										<p class="para2">usage</p>
									</div>

									<div class="Pronunciation">
										<!-- <h4>Pronunciation</h4> -->
										<p class="para3">pronunciation</p>

									</div>
								</div>
							</center>
						</div>
				</div>
			</div>
		</section>
		<!-- <section id="section-3">
			<div class="vs-content">
				<div class="col">

				</div>
			</div>
		</section> -->
		<section id="section-4">
			<div class="vs-content">
				<div class="col">
					content of about

											<?php
											$sql = "select * from fav";
											$result=mysqli_query($conn,$sql);

											$rowcount=mysqli_num_rows($result);

											for($x=$rowcount;$x>0;$x=$x-1){
												$query=mysqli_query($conn,"select * from fav where id =$x");
												$row=mysqli_fetch_array($query);
												$query_of_user = $row['user_id'];
												if($query_of_user != $user_id) continue;
												$fav_word_id =$row['word_id'];

												$table_id = $row['table_id'];
												if($table_id==0){
												$query2 = "SELECT word,meaning,sentence FROM trending WHERE id='".$fav_word_id."'";
												$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn).$query2);
												$word2 = mysqli_fetch_array($result2);
												}
												else{
													$query2 = "SELECT word,meaning,sentence FROM dictionary WHERE id='".$fav_word_id."'";
													$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn).$query2);
													$word2 = mysqli_fetch_array($result2);

												}
												$word = $word2['word'];
												$meaning = $word2['meaning'];
												$sentence = $word2['sentence'];
												echo '<p id="rcorners2">'.$word.'<br />'.$meaning.'<br />'.$sentence.'</p>';
											}
											 ?>
				</div>
			</div>
		</section>
	</div>

	<script src="js/classie.js"></script>
	<script src="js/hammer.min.js"></script>
	<script src="js/main.js"></script>

</div>


</body>



</html>
