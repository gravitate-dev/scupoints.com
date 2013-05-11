<?php
include_once("mysql.scupoints.inc.php");
?>
<html>
<html lang="en">
    <head>
	<script src="jquery/jquery.js"></script>
	<script src="js/qtip2.js"></script>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>SCU Points[Homepage]</title>
        <meta name="description" content="Sell your SCU dining points for money!" />
        <meta name="author" content="rirribarren" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/qtip2.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		
		<!--JQUERY UI HERE -->
		<link rel="stylesheet" href="jquery-ui-1.10.2.custom/css/blitzer/jquery-ui-1.10.2.custom.css"/>
		<script src="jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css" />
		<style>
		body { font-size: 62.5%; }
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
		</style>
		<!-- JQUERY UI ABOVE -->
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
			
			#main-content{
			width: 700px;
			margin-top: auto; margin-bottom: auto;
			height:auto;
			text-align: center;
			margin:0px;
			margin-left: 360px;
			margin-right: 10px;
			background-color: white;
			zoom: 1;
			  filter: alpha(opacity=50);
			  opacity: 0.5;
			-webkit-transition: opacity 1s ease-in-out;
			-moz-transition: opacity 1s ease-in-out;
			-ms-transition: opacity 1s ease-in-out;
			-o-transition: opacity 1s ease-in-out;
			transition: opacity 1s ease-in-out;
			}
			
			#main-content:hover {
			zoom: 1;
			  filter: alpha(opacity=100);
			  opacity: 1;
			}
			#side-bar{
			margin-top: auto; margin-bottom: auto;
			float: left;
			height: 100%;
			width: 350px;
			margin-top: 0px;
			background-color: #7D1411;
			zoom: 1;
			  filter: alpha(opacity=50);
			  opacity: 0.5;
			-webkit-transition: opacity 1s ease-in-out;
			-moz-transition: opacity 1s ease-in-out;
			-ms-transition: opacity 1s ease-in-out;
			-o-transition: opacity 1s ease-in-out;
			transition: opacity 1s ease-in-out;
			}
			#side-bar:hover + #main-content {
			zoom: 1;
			  filter: alpha(opacity=100);
			  opacity: 1;
			}
			
			#side-bar:hover {
			zoom: 1;
			  filter: alpha(opacity=100);
			  opacity: 1;
			}
			
			#points_label, #verify_label, #profile_label {
				margin-top: 20px;
				margin-left: 5px;
				font-size: 32px;
				color : white;
			}
			#verify_label {
			color: #0000EE;
			text-decoration: underline;
			}
			.points_options  {
				position:relative;
				top: 20px;
				left: 35px;
				margin-top: 20px;
				margin-left: 5px;
				font-size: 20px;
				color : white;
			}
			input.rounded {
				margin-top: 10px;
				margin-left: 5px;
				width: 90%;
				border: 1px solid #ccc;
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				-moz-box-shadow: 2px 2px 3px #666;
				-webkit-box-shadow: 2px 2px 3px #666;
				box-shadow: 2px 2px 3px #666;
				font-size: 12px;
				padding: 4px 7px;
				outline: 0;
				-webkit-appearance: none;
			}

			input.rounded:focus {
			border-color: #339933;
			}
			

			
			#welcome_span {
			font:normal 40pt Arial;
			color:#EA1212;
			text-shadow: 0 1px 0 #ccc,
			0 2px 0 #c9c9c9,
			0 3px 0 #bbb,
			0 4px 0 #b9b9b9,
			0 5px 0 #aaa,
			0 6px 1px rgba(0,0,0,.1),
			0 0 5px rgba(0,0,0,.1),
			0 1px 3px rgba(0,0,0,.3),
			0 3px 5px rgba(0,0,0,.2),
			0 5px 10px rgba(0,0,0,.25),
			0 10px 10px rgba(0,0,0,.2),
			0 20px 20px rgba(0,0,0,.15);
			}
			
			.points_checkbox {
			margin-left: 15px;
			margin-top: 5px;
			}
			.emailPerson {
	background:#25A6E1;
	background:-moz-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#25A6E1),color-stop(100%,#188BC0));
	background:-webkit-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:-o-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:-ms-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#25A6E1',endColorstr='#188BC0',GradientType=0);
	padding:8px 13px;
	color:#fff;
	font-family:'Helvetica Neue',sans-serif;
	font-size:17px;
	border-radius:4px;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border:1px solid #1A87B9;
	margin-bottom: 15px;
}
.fb-like
{
margin-top:10px;
}

#update-points, #logout{
margin-top: 50px;
margin-left: 5%;
width:80%;
font-size:3em;
}
#formInfo {

font-size: 17px;
margin-left: 5px;
}

			.search_result_entry {
			text-align: left;
			margin-top: 10px;
			margin-left: 50px;
			font-size: 24px;
			}
			
.fbImg {
position: relative;
top: 200px;
width: 200px;
height: 200px
}

.contactInfo {
margin-left: 210px;
}
		</style>
		<script>
		//Javascript main is here for my webpage
		$(function() {
		
		//jquery ui dialog handler hooked here
		var dialogfield_Points = $( "#dialogfield_Points" ),
		dialogfield_PPD = $( "#dialogfield_PPD" ),
		allFields = $( [] ).add( dialogfield_Points ).add( dialogfield_PPD );	


		function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
		o.addClass( "ui-state-error" );
		updateTips( "Length of " + n + " must be between " +
		min + " and " + max + "." );
		return false;
		} else {
		return true;
		}
		}
		
		$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 400,
		width: 550,
		modal: true,
		buttons: {
		"Set your new info": function() {
		var bValid = true;
		allFields.removeClass( "ui-state-error" );
		
		bValid = bValid && checkLength( dialogfield_Points, "Points", 1, 4 )


		bValid = bValid && checkLength( dialogfield_PPD, "Points Per Dollar", 1, 5 );
		
		
		if ( bValid ) {
		//where we call an ajax script to update the mysql data
		if (email_from == "none"){ alert("reload page"); return; }
		$.post("updateRates.php", { emailFrom: email_from, Points: dialogfield_Points.val(), Ppd: dialogfield_PPD.val() })
		.done(function(data) {
		alert(data);
		});
		$( this ).dialog( "close" );
		}
		},
		Cancel: function() {
		$( this ).dialog( "close" );
		}
		},
		close: function() {
		allFields.val( "" ).removeClass( "ui-state-error" );
		}
		});
		
		$( "#update-points" )
		.button()
		.click(function() {
		$( "#dialog-form" ).dialog( "open" );
		});
		
		$( "#logout" )
		.button()
		.click(function() {
		window.location = "logout.php";
		});

		//add the qtip to the verify facebook item
		$('#verify_label').qtip({
		content: 'By Verifying yourself on Facebook, people are way more likely to contact you when they want to buy your dining points from you, although you do not have to, <strong>It is highly reccomended that you do verify</strong>',
		position: {
			my: 'top left',
			target: 'mouse',
			viewport: $(window), // Keep it on-screen at all times if possible
			adjust: {
				x: 10,  y: 10
			}
		},
		hide: {
			fixed: true // Helps to prevent the tooltip from hiding ocassionally when tracking!
		},
		style: {
			'font-size': 64,
			name: 'cream'
		}
	});
	
		var email_from = "<?php echo (isset($_SESSION['email'])==true && !empty($_SESSION['email'])) ? $_SESSION['email']."@scu.edu" : "none"; ?>";
		//when they enter the points here it will do ajax on a page that searches for points with the best rates
		$('#fbVerified').click (function ()
		{
		$('#points').trigger('change');
		});
		$('#points').change(
		 function myOnchange() {
		 if (!$(this).val()){return;}
			//the ajax is called here
			$.post("search.php", { points: $('#points').val(), fbVerify: $('#fbVerified').is(":checked") })
			.done(function(data) {
				//alert("Data Loaded: " + data);
				var obj = jQuery.parseJSON(data);
				//first destroy all elements first
				$(".search_result_entry").remove();
				//then append the datas
				for ( var i = 0; i < obj.length-1; i++)
				{
					var new_div;
					if (obj[i].isFBConnect==0)
						new_div = createDivFromDataNoFB(obj[i]);
					else
						new_div = createDivFromDataYesFB(obj[i]);
					
					
					$("#results").append(new_div);
				}
				
				//after appending the results we have to register the click listeners!
				$(".emailPerson").click(function() {
					var email_to = $(this).attr("data-email");
					var points = $(this).attr("data-points");
					var isNumber =  /^\d+$/.test(points);


					if (isNumber == false)
					{
						alert("Invalid points");
						return;
					}
					console.log(email_to);
					console.log(points);
					console.log(email_from);
					if (email_from == "none"){ alert("reload page"); return; }
					$.post("sendEmail.php", { points: $('#points').val(), emailFrom: email_from, emailTo: email_to })
					.done(function(data) {
					alert(data);
					});
				});
					
				});
				$('#points').trigger("change");
			});
			
			//the end of "main" for Jquery
			<?php 
				// if they didnt set their rates then we have to 
				// show the dialog for them
				if (hasSetRates($_SESSION['email'])==False)
				{
					echo<<<dialogopen
					$( "#dialog-form" ).dialog( "open" );
dialogopen;
				}
			?>
		});
		
		function createDivFromDataNoFB( data )
		{
			var ans = "<div class='search_result_entry'><div class='contactInfo' >";
			//lets put the name here
			ans += "Email: "+data.Email+"</br>";
			ans += "Points Owned: "+data.Points+"</br>";
			ans += "Points Per Dollar: "+data.PPD+"</br>";
			ans += "<button class='emailPerson' data-email='"+data.Email+"'"+" data-points='"+$('#points').val()+"'>Send An Email</button></br>";
			ans += "</div></div>";
			return ans;
		}
		
		function createDivFromDataYesFB( data )
		{
			var fb_img_url = 'https://graph.facebook.com';
			var loc = data.fb_link;
			fb_img_url += loc.substring(loc.lastIndexOf('/'));
			fb_img_url += '/picture';
			var ans = "<div class='search_result_entry'>";
			//lets put the name here
			ans += "<a href='"+data.fb_link+"'><img class='fbImg' src='"+fb_img_url+"'/></a><div class='contactInfo' >";
			ans += "Facebook Verified!</br>";
			ans += "Name: "+data.Name+"</br>";
			ans += "Email: "+data.Email+"</br>";
			ans += "Points Owned: "+data.Points+"</br>";
			ans += "Points Per Dollar: "+data.PPD+"</br>";
			ans += "<button class='emailPerson' data-email='"+data.Email+"'"+" data-points='"+$('#points').val()+"'>Send An Email</button></br>";
			ans += "</div></div>";
			return ans;
		}
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
<?php
	//if the email isnt set they have to go to the register/login page which is the same thing
	if (isset($_SESSION['email']) == False)
	{
		echo<<<redir
		<script>
		window.location="register.php";
		</script>
redir;
	}
?>
	<div class="codrops-top">
		<a href="main.php"><strong>&laquo; HomePage: </strong></a>
		<span class="right" style="width:70%;"><marquee><strong>SCU Points</strong></marquee></span>
     </div>
	 
	<div id="side-bar">
		<div id="points_label">Search for points</div>
		<input type="text" id="points" name="points" class="rounded" placeholder="Enter # of points wanted"/>
		<span class="points_options">Has Facebook Verified</span>
		<input type="checkbox" name="fbVerified" value="fbVerified" id="fbVerified" class="points_checkbox"/>

<!-- the jquery form -->
<div id="dialog-form" title="Update Your Points">
	<p class="validateTips">All form fields are required.</p>
	<form>
	<div id="formInfo">
	<p>We don't automatically track your points, you have to enter them in for others to see</p>
	<ul>
	<li>Points: How many dining points you want to sell
	<li>Points Per Dollar: The larger the number, means you will give more points per dollar, which makes your ranking higher in the search results</li>
	</ul>
	</div>
	<fieldset>
	<label for="dialogfield_Points">Points</label>
	<input type="text" name="dialogfield_Points" id="dialogfield_Points" class="text ui-widget-content ui-corner-all" />
	<label for="dialogfield_PPD">Points Per Dollar</label>
	<input type="text" name="dialogfield_PPD" id="dialogfield_PPD" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
<button id="update-points">Update Points</button></br>
<button id="logout">Logout</button>


		<?php
		if (hasVerifiedFacebook($_SESSION['email']) == False)
		{
		?>
		<a href="verifyFacebook.php"><div id="verify_label" title="This is my tooltip">Verify Facebook</div></a>
		<?php
		} 
		?>
	</div>
	<div id="main-content">
		<span id="welcome_span">Welcome <?php echo $_SESSION['email']; ?><br></span>
		<img src="images/coverimage.png" width=600/></br>
		<div class="fb-like" data-href="http://www.scupoints.com/verifyFacebook.php" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
		<div id="results">
		<div class='search_result_entry'>&nbsp </div>
		<div class='search_result_entry'>&nbsp </div>
		<div class='search_result_entry'>&nbsp </div>
		</div>
					   
	</div>​
</body>
</html>
