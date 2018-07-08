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
	if(empty($_POST['terms'])){
		$errors[] = 'The terms cannot be empty.';
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
    			header("location: ../mainpage/index.php");
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
		<link rel='shortcut icon' type='image/gif' href='img/Lex.gif'/>
		<link rel="stylesheet" type="text/css" href="css/base.css" />


		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>


		<script>document.documentElement.className="js";
		var supportsCssVars=function(){var e,t=document.createElement("style");
		return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};
		supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");
		function readURL(input) {
			if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#blah').attr('src', e.target.result).width(80).height(80);
			};

			reader.readAsDataURL(input.files[0]);
			}
		}

		function disableSubmit() {
			document.getElementById("submit").disabled = true;
		}

		function activateButton(element) {

			if(element.checked) {
				document.getElementById("submit").disabled = false;
			}
			else  {
				document.getElementById("submit").disabled = true;
			}
		}
		</script>
<style>

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
  width: 80%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
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
  color: #06D85F;
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
		</head>
	<body class="demo-1 loading">

		<main>
			<div class="content content--side">

				<header class="codrops-header">
					<h1 class="codrops-header__title">LEX-ICON SIGNUP</h1>
				</header>

				<div>
				<?php
				 if(empty($errors)===false){
			  ?>
					<ul>
						 <?php
						 		foreach($errors as $error){
									echo "<li>$error</li>";
								}
				 		 ?>
					</ul>
					<?php
					}
					?>
				</div>
				<form class="form" action="index.php" method="POST" enctype='multipart/form-data' onload="disableSubmit()">
					<div class="form__item">
						<label class="form__label" for="name">Full Name</label>
						<input class="form__input" type="text" name="name" id="name" required="" value="<?php if(isset($_POST['name'])) echo htmlentities($_POST['name']); ?>">
					</div>
					<div class="form__item">
						<label class="form__label" for="email">Email Address</label>
						<input class="form__input" type="email" name="email" id="email" required="" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
					</div>
					<div class="form__item">
						<label class="form__label" for="username">Username</label>
						<input class="form__input" type="username" name="username" id="username" required="" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>">
					</div>
					<div class="form__item">
						<label class="form__label" for="password">Password</label>
						<div class="form__input-wrap">
							<input class="form__input" type="password" name="password" id="password" required="" value="<?php if(isset($_POST['password'])) echo htmlentities($_POST['password']); ?>">
							<p class="form__password-strength" id="strength-output"></p>
							<br><br>
						</div>
					</div>
					<div class="form__item">
						<label class="form__label" for="repeat_password">Repeat Password</label>
						<div class="form__input-wrap">
							<input class="form__input" type="password" name="repeat_password" id="reppassword" required="" value="<?php if(isset($_POST['repeat_password'])) echo htmlentities($_POST['repeat_password']); ?>">
						</div>
					</div>
					<div class="form__item">
						<img id="blah" src="#" onerror="this.src='img/default.jpg'" style="height: 7em; width: 5em;" />
						<div>
						<label for="files" class="btn" style="cursor:pointer;"><span><a class="form__link">Upload your photo</a></span></label>
						<input type='file' onchange="readURL(this);" name="file" id="files" style="visibility:hidden;" required=""/>
					</div>
					</div>
					<input type="checkbox" name="terms" id="terms" onchange="activateButton(this)" required> I Agree<a class="button" href="#popup1"> Terms & Conditions</a>

					<div class="form__item form__item--actions">
						<span>Already have an account? <a class="form__link" href="../login/index.php">Login here</a></span>
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
		<div id="popup1" class="overlay">
			<div class="popup">
				<h2>Terms and Conditions</h2>
				<a class="close" href="#">&times;</a>
				<div class="contentA">
					<pre>1. Who we are and Why this

lex-icon.azurewebsites.net is maintained by __________ (“LI”).   At times LI may also be referred to as “we”, “us”, or “lex-icon.azurewebsites.net”.  The person who is viewing or interacting this site we will refer to as “you”, “hey you”, or where appropriate “jerkface” (only if you’re being bad).

This Terms of Service Agreement (“Agreement”) is our contract with you, and tells you what you can and can’t do and what we can and can’t do with you.


2.  VERY BAD THINGS THAT YOU CANNOT DO

We want you to like us, we do. But the internet is dangerous, and we don’t like danger spilling over onto our website. So while some of this may seem OBVIOUS, we have to tell you because sometimes its good to be reminded.  So when using our site we expect the following:

Don’t Spam, or use this site to sell your crap without our permission.  This isn’t the classified section of the newspaper;
Don’t give us viruses or try and hack your way into our computers;
Don’t post words in the trending section that are useless;
Don’t be a robot.  Robots are evil.  That means don’t use auto posters that are meant to leave things like “You site has great informashuns!  Thank you! Best content 2018! I my wife tell me about your site, I say I no believe but she write…you best Site!” with anchor text to your crappy site about “Best Kanpur Dog Groomers”.  Seriously….don’t.
Don’t be a jerkface.  A jerkface is someone who discriminates, defrauds, hates, or acts like an idiot. Don’t do any of that.  We’ll ban you
Don’t post things that you’re not supposed to or don’t have permission for.
Don’t do other things that we don’t like, which is up to us.
If you follow the rules, you can stay. If you don’t, we can kick you out, haul your ass to court, or tell the Alphabet boys what you’ve done so they’ll put you under surveillance.  Our failure to enforce against one person is not a waiver to enforce our rights at any time for the same or different offenses.

3.  INTELLECTUAL PROPERTY

Don’t steal our stuff.  By stuff, we mean the awesome content, words, pictures, sounds (ummm, not sure what kind of sounds we’ll make…but you can be sure you can’t have them without our permission) (altogether known as “Content”).  So our Content is protected by all the freaking laws you can think of.  Seriously. This includes Indian Copyright Law (15 I.C.A Section (weirdsquigglythinginsertedhere) 107).  This means don’t use it, think of using it, or even stare at it with the intention of doing something we didn’t give you permission to do.

If you’re giving us content for our site, you’re pinky swearing that it’s yours or you have permission to use it in the way you’re using it.  Violations of other people’s “stuff” is not taken lightly here at LI, as we don’t like it when people jack our Content.  So if you jack someone else’s and try and pass it off to us like “oh hey bro, it’s cool you can totally use this”  then you’re going to pay for anything bad that happens to us, our employees, our advertisers, vendors, family pets, or agents.

Since we are opposed to copyright infringement we are registered in accordance with the Digital Millennium Copyright Act (“DMCA”) to receive notices of copyright infringement or if you otherwise believe your intellectual property rights have been violated.  To send us a DMCA takedown notice, please contact us through our contact form on the site.    The DMCA notice should identify in the subject line our website, the words DMCA Notice, the name of the copyright owner and if applicable, your name if you are someone other than the owner, the title (and preferably URL, if Internet-based) of the work being infringed, the location of the infringing material on our site, and the following statement:

I have a good faith belief that use of the copyrighted materials described above as allegedly infringing is not authorized by the copyright owner, its agent, or the law.  The information in this notification is accurate and I swear, under penalty of perjury, that I am the copyright owner or am authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.

You must sign the notice, and if you send it by e-mail, an electronic signature is fine.

4.  RESPONSIBILITIES AND YOU BREAK IT YOU BOUGHT IT.

LI may allow you to post content.  You agree you will only post in accordance to this Agreement, and agree to remain responsible for anything that you post.  By posting your content you’re giving us the right to use that content via a license to use it how we please.  Seriously, we can take your content and hack the crap out of it, spin it, and even make money off of it without paying you a dime.  We’ll send you a fruit basket though…maybe…actually probably not.  This “license” is not revocable and goes on forever and ever and ever and ever.  But wait, there’s more.  If anything bad happens because of something you submit, you agree to pay us, our legal bills, or other bills that may result because of what you submit.

5.  U MAD?  GONNA LAWYER UP BRO?

We have lawyers.  A whole team of them that are ready to knife fight on a whim, but we’d rather resolve this like gentlemen.  So if you have a problem you will first come to us and tell us about this problem.  We may talk about this problem for awhile, and if neither side is happy with the result then we can duke it out in Court.  The Court must be in Uttar Pradesh, and will be decided based on UP law.  Any law that applies or controls this contract is UP law.   YEA DOG, that’s right, you just got hometurfed broseph.  But you’re agreeing to this hometurf being UP because we have to have one universal location to resolve disputes in.  Oh, and the winner of any dispute or lawsuit is entitled to have their attorneys’ fees and costs paid for by the loser.

6.  SURVIVAL OF THE DEAD….AGREEMENT

Sometimes, people mutually agree to stuff that courts just won’t uphold.  That shouldn’t affect the intent of our contract, though, so you agree that if a judge declares a portion of these Terms of Service of no effect, the rest of the Terms of Service will stay in effect as much as is still possible without the part that the judge struck down.

7.  THIRD PARTY SHARING

Our site may have links to third party websites that we have no control over, such as YouTube, Facebook, and MySpace (seriously..who uses myspace anymore?).   We have no responsibility over this content (although I those companies want to give us free shares in their company we’re cool with that) and therefore you have to take up any problems you have with those sites with their owners.  Leave us out of it.

8.  LOUD NOISES

WE HAVE TO USE CAPS LOCK FOR THIS SECTION BECAUSE SOME DEAD GUY 100 YEARS AGO PROBABLY SAID IF WE DON’T THEN IT DOESN’T COUNT.  SO WE CAN’T GUARANTEE THAT OUR SITE WON’T BREAK YOUR COMPUTER OR THAT YOU’LL FIND IT AMUSING OR THAT IT WILL HELP YOU MAKE MONEY.  WE TRY OUR BEST, BUT THAT’S ALL YOU GET JUST LIKE WHEN YOU BUY SOMETHING AT A RANDOM GARAGE SALE…YOU’RE BUYING IT “AS IS” EVEN IF IT BLOWS UP OR FRIES YOUR BRAIN.  SO EVEN IF SOMETHING TERRIBLE AND CATASTROPHIC HAPPENS BECAUSE YOU VIEWED OUR SITE, YOU CAN’T SUE US, OR ANYONE THAT IS CONNECTED WITH US. SINCE WE’RE IN UTTAR PRADESH, AND YOU MIGHT BE UTTAR PRADESH WE HAVE TO TELL YOU ABOUT THAT FANCY LAW THAT SAYS IF YOU GIVE UP YOUR “GENERAL” RIGHTS TO CLAIMS YOU DON’T HAVE TO GIVE UP YOUR RIGHTS TO CLAIMS THAT YOU COULDN’T HAVE KNOWN ABOUT (MAKES SENSE RIGHT?) WELL GUESS WHAT YOU ARE GIVING THOSE RIGHTS UP BECAUSE THIS IS A CONTRACT AND WE JUST TOLD YOU.  SORRY!  SO WE’RE DISCLAIMING ALL WARRANTIES AND LIABILITY FOR ANYTHING AND EVERYTHING, WHETHER OR NOT WE KNEW OR SHOULD HAVE BEEN PSYCHIC AND KNEW.  KING OF THE CASTLE MEANS THAT WHEN YOU COME INTO OUR SITE, YOU PLAY BY OUR RULES AND IF WE END UP BEING RESPONSIBLE FOR SOMETHING WE’RE NOT GOING TO PAY YOU A PENNY MORE THAN WHAT YOU MAY HAVE PAID US IN THE PAST MONTH, OR Rs.50 WHATEVER IS SMALLER.  IF YOU’RE FROM ONE OF THOSE WEIRD STATES THAT SAY YOU CAN’T HAVE PROVISIONS LIKE THIS IN A CONTRACT, OR THAT WE CAN’T LIMIT WHAT WE PAY THEN OUR DAMAGES ARE LIMITED TO THE SMALLEST, TEENIEST, TINIEST, BIT ALLOWED BY LAW.  WOMP WOMP.

9. MISC THINGS

IF YOU’RE FROM A FOREIGN COUNTRY, WELCOME..GUTENTAG, NEI HO, BONJOUR, JAMBO, HOLA……we’re going to be transferring your information from our country to yours, so you’re ok with us transferring this information by virtue of having visited and used our site.  Unless you’re from Germany, then…well…..let us know and we’ll figure out what to do with you.   Headings to these sections are meant to be for entertainment purposes only and have no binding effect.  We can transfer our rights and obligations in this agreement whenever we want.  Just because we don’t put someone in a burlap sack and beat them with a sock full of quarters for violating any section of this Agreement doesn’t mean we’re waiving our right to enforce our Agreement, it just means we’re cutting someone some slack.  It doesn’t mean we’ll do the same for you or anyone else.  Too bad, we do what we want because we’re the honey badgers of people who love English Language.   Follow the law and don’t be a jerkface.
</pre>
				</div>
			</div>
		</div>
		<script src="js/imagesloaded.pkgd.min.js"></script>
		<script src="js/zxcvbn.js"></script>
		<script src="js/demo1.js"></script>
	</body>
</html>
