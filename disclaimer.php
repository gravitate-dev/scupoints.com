<?php
include_once("mysql.scupoints.inc.php");
?>
<html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>SCUPoints[About]</title>
        <meta name="description" content="Sell your SCU Dining Points for Cash" />
        <meta name="author" content="rirribarren" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="jquery/jquery.js"></script>
		<script src="js/modernizr.custom.63321.js"></script>
		<script type="text/javascript" src="totemticker/jquery.totemticker.min.js"></script>
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
			
			.about-box{
			background-color: rgba( 127, 127, 127, 0.7);
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
			
		.main
		{
		width: 50%;
		color: white;
		text-align:center;
		}
		.main p
		{
		font-size: 20px;
		color:black;
		font-weight:bold;
		}
	#comslider_in_point_1320
	{
	position: relative;
	left: 100px;
	}
		</style>
		<script>
		</script>
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
			
				<img src="images/coverimage.png"/></br><h1><strong>Privacy Policy</strong></h1>
				<div class="fb-like" data-href="http://www.scupoints.com/main.php" data-send="true" data-width="450" data-show-faces="true"></div>
				<h2>Don't waste leftover points</h2>

				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			<section class="main">
					<div class="about-box">
					<h2><strong>End User License Agreement</strong></h2>
					<p>
					<ul>
					<li>This site only provides contact between two SCU students
					<li>Selling points is done solely at the disgression of the two SCU students
					<!--<li><strong>You believe that a required Meal Plan for 1000 points for housing is unfair.</strong>-->
					</ul>
					</p>
					</div>
			</section>
			
        </div>
</body>
</html>