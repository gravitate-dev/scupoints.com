<?php
include_once("mysql.scupoints.inc.php");
$response = "";
$skip = false;
$password_change = false;
//STEP 1 of 3 We create the form to change password request which sends you an email
if (isset($_POST['email']))
{
	$response = sendPasswordReset($_POST['email'] );
	if (strstr($response,"Success") != False) //if success is found
	{
		$_SESSION['response'] = $response;
		$_SESSION['email'] = strtok($_POST['email'],'@');
		$skip = false;
		
	}
}

//SET 2 of 3 Check to see if the code from the email matches
if (isset($_GET['code']) && isset($_GET['email']))
{
	//we check to see if the code matches their email if it does then we echo the form to reset the password
	if ($_GET['code']==calculateResetCode($_GET['email'])) {
		$_SESSION['email_authorized'] = $_GET['email'];
		$password_change = true;
		}
	else
		die("Code invalid");
	
}

//STEP 3 of 3 then we check here to see passwords match and we change them
if (isset($_POST['newpass']) && isset($_POST['newpass2']))
{
	if ($_POST['newpass'] == $_POST['newpass2'])
	{
		$response = resetPassword( $_SESSION['email_authorized'], $_POST['newpass'] );
		if (strstr($response,"Password Updated") != False) //if Password Updated is found that means they registered
		{
			//redirect to the main login because they did it right
			echo <<<redir
			<script>
			window.location="register.php";
			</script>
redir;
		}
	}
}
?>
<html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>SCUPoints[Register]</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
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
			border:solid 2px #D55544;
			background: #F6CBCA;
			color:#DE645C;
			padding:4px;
			text-align:center;
			}
			.clean-red > a {
			color: #FFAACC;
			}
			
		</style>
    </head>
<body>
        <div class="container">
		
			<!-- Codrops top bar -->
            <div class="codrops-top">
			<a href="main.php"><strong>&laquo; HomePage: </strong></a>
                 <span class="right" style="width:70%;"><marquee><strong>SCU Points</strong></marquee></span>
            </div><!--/ Codrops top bar -->
			
			<header>
			
				<h1>SCU Points<br><strong>Reset Password Form</strong></h1>
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
				    

					<?php if ($password_change==False)
					{
					
					?>
					<h1>Enter your email</h1>
				    <p>
				        <label for="email">SCU email</label>
				        <input type="text" name="email" placeholder="SCU Email" required>
				    </p>
					<?php
					} else
					{
					?>
					<h1>Enter your new password</h1>
					<p>
				        <label for="newpass">Enter New Password</label>
				        <input type="password" name="newpass" placeholder="Password" required>
				    </p>
					
					<p>
				        <label for="newpass2">Re-Enter New Password</label>
				        <input type="password" name="newpass2" placeholder="Password Again" required>
				    </p>
					<?php
					}
					?>
					<p>
						<?php 
						if (strstr($response,"Success")==False && strlen($response) > 3)
						{ 
						echo "<span class='clean-red' id='response'>".$response."</span>"; 
						} 
						?>
					</p>

				    <p>
				        <input type="submit" name="submit" value="Continue">
				    </p>       
				</form>​
			</section>
			
        </div>
</body>
</html>