<?php
include_once("mysql.scupoints.inc.php");
$response = "";
$skip = false;

if (isset($_POST['password']) && isset($_POST['email']))
{
	$response = registerUser($_POST['email'], md5($_POST['password']));
	if (strstr($response,"Success") != False) //if success is found
	{
		$_SESSION['response'] = $response;
		$_SESSION['email'] = strtok($_POST['email'],'@');
		$skip = true;
		if (strstr($response,"Registration") != False) {//if check email is found that means they registered
			sendConfirmation($_POST['email']);
			echo <<<alert_verify
			<script>
			alert("Please check your SCU email! We sent you a link for you to verify your account.");
			</script>
alert_verify;
		}
		
	}
}
if ($skip == True)
{
echo<<<redir
<script>
window.location="main.php";
</script>
redir;
}
if ($skip == False)
{
?>
<html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>SCUPoints[Register]</title>
        <meta name="description" content="Sell your SCU Dining Points for Cash" />
        <meta name="author" content="rirribarren" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>	
			@import url(http://fonts.googleapis.com/css?family=Raleway:400,700);
			body {
				background: #7f9b4e url(images/scubg.png) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
			marquee {
			marquee-speed: slow;
			}
			.clean-red{
			position: relative;
			border:solid 2px #D55544;
			background: #F6CBCA;
			color:#DE645C;
			padding:4px;
			text-align:center;
			margin-bottom: 10px;
			}
			.clean-red > a {
			color: #0000EE;
			text-decoration: underline;
			}
			.clean-red > a:hover {
			color: #0000EE;
			text-decoration: underline;
			text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #ff00de, 0 0 70px #ff00de, 0 0 80px #ff00de, 0 0 100px #ff00de, 0 0 150px #ff00de;
			}
			
			.fb-like {
			background-color: rgba(255,255,255,0.5);
			}
		</style>
    </head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=312549098871198";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <div class="container">
		
			<!--/ Codrops top bar -->
			<div class="codrops-top">
			<a href="main.php"><strong>&laquo; HomePage: </strong></a>
                 <span class="right" style="width:70%;"><marquee><strong>SCU Points</strong></marquee></span>
            </div><!--/ Codrops top bar -->
			
			<header>
			
				<!--<h1>SCU Points <strong>Login Form</strong></h1>-->
				<img src="images/coverimage.png"/></br>
				<div class="fb-like" data-href="http://www.scupoints.com/main.php" data-send="true" data-width="450" data-show-faces="true"></div>
				<h2>Don't waste leftover points</h2>

				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			
			<section class="main">
<!--
<iframe src="https://www.facebook.com/plugins/registration?client_id=312549098871198&redirect_uri=http://www.gunzhaxplz.com/scupoints.com/register.php&fields=name,gender,email,first_name,last_name"
        scrolling="auto"
        frameborder="no"
        style="border:none"
        allowTransparency="true"
        width="100%"
        height="390"></iframe>
		-->
				<form action="" method="POST" class="form-4">
				    <h1>Login or Register</h1>
					<p>
						<?php 
						if (strstr($response,"Success")==False && strlen($response) > 3)
						{ 
						echo "<div class='clean-red' id='response'>".$response."</div>"; 
						} 
						?>
					</p>
				    <p>
				        <label for="email">SCU email</label>
				        <input type="text" name="email" placeholder="SCU Email" required>
				    </p>
				    <p>
				        <label for="password">Password</label>
				        <input type="password" name='password' placeholder="Password" required> 
				    </p>

				    <p>
				        <input type="submit" name="submit" value="Continue">
				    </p>
					<div style="background-color:rgba(127,127,127,0.6);">
					<p style="margin-top:10px;">
						<a href="faq.php" style="color:white; text-decoration:underline;font-size:25px;">What is SCU Points?</a>
					</p>
					<p style="margin-top:10px;">
						<a href="disclaimer.php" style="color:white; text-decoration:underline;font-size:25px;">Disclaimer</a>
					</p>
					<p style="margin-top:10px;">
						<a href="policy.php" style="color:white; text-decoration:underline;font-size:23px;">Our Privacy Policy!</br></a>
					</p>
					<p style="margin-top:10px;">
						<a href="http://www.scuclasses.com" style="color:white; text-decoration:underline;font-size:23px;" target="blank">Register Classes Early!</br> SCUClasses.com</a>
					</p>
					<p style="margin-top:30px;font-size:12px">
						Made by Robbie Irribarren rirribarren@scu.edu
					</p>
				</form>​
			</section>
			
        </div>
</body>
</html>
<?php
}
?>