<?php
include_once("mysql.scupoints.inc.php");
include_once("fb/facebook.php");

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId' => '312549098871198',
  'secret' => '7572eca68721aa11321ff187850a7ca0',
));
// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');

?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>SCUPoints[Register]</title>
        <meta name="description" content="Sell your SCU dining points for money!" />
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
			.clean-fb{
			position: relative;
			border:solid 2px #4C66FF;
			background: #4C66A4;
			color:white;
			padding:4px;
			text-align:center;
			margin-bottom: 10px;
			}
			.clean-fb > a {
			color: #FFFFFF;
			text-decoration: underline;
			}
		</style>
    </head>
<body>
        <div class="container">
		
			<!--/ Codrops top bar -->
			<div class="codrops-top">
			<a href="main.php"><strong>&laquo; HomePage: </strong></a>
                 <span class="right" style="width:70%;"><marquee><strong>SCU Points</strong></marquee></span>
            </div><!--/ Codrops top bar -->
			
			<header>
			
				<h1>SCU Points <strong>Facebook Verify</strong></h1>
				<h2>Don't waste leftover points</h2>

				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			
			<section class="main">
<?php if ($user): ?>
<a href="<?php echo $logoutUrl; ?>">Logout</a>
<?php else: ?>
<div class="clean-fb">
<a href="<?php echo $loginUrl; ?>"><strong>Login with Facebook</strong></a>
</div>
<?php endif ?>

<?php if ($user){ ?>
<h3>You</h3>
<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

<h3>Your User Object (/me)</h3>
<pre>
<?php
//HERE WE CHECK TO SEE IF THE LOGGED INTO FACEBOOK THEN WE EDIT THE DATA!
if (!empty($user_profile))
{
	updateAccountWithFBInfo($_SESSION['email'],$user_profile['link'],$user_profile['name'],$user_profile['gender']);
	echo<<<redir
	<script>
	window.location="main.php";
	</script>
redir;
die();
}
}
?></pre>
			</section>
			
        </div>
</body>
</html>