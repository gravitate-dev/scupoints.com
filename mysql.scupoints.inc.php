<?php
//todo describe how a trade should go down

//start at 5:00 PM
//CHECKPOINT at 8:00
/*
* You can register
* Only allows @scu.edu
* Verification by email done
* Styled the registration page
//end at 
*/
//CHECKPOINT AT 8:30
/*
* Forgot password done
*/
//CHECKPOINT AT 10:30
/*
* Styled the pages to fade in and fade out in the main.php
*/
//5.5 hours coded non-stop

//Took break 
//Start at 9:30
//CHECKPOINT 11:00 PM
/*
* I added the points handler and styled the points input box
* Starting on the ajax for the searching on the mysql database
*/
//CHECKPOINT 12:30 AM PAST MIDNIGHT
/*
* I made the feature to send email to the person that you searched
* I made the div boxes echoed when you search for points
* Made FB vs NON-FB verified divs echo different information
*/
//CHECKPOINT 1:30 AM
/*
* Took a while to integrate qTIP2 in JQUERY
* The send email function works
* Facebook verification is now on the way
*/
//CHECKPOINT 2:30 AM
/*
* Created the verify with facebook finished wow that took some time
* The verified facebook is now in the search results how cool!
* resizing the fonts in the results list
*/
//CHECKPOINT 3:00 AM
/*
* The facebook verified checkbox now updates the list
*/
//CHECKPOINT 3:15 AM
/*
* Updated Facebook app information including description in the facebook page
* Made the verification disappear once you have verified on facebook
* Made the checkbox facebook verified work when people click it
* WOW i didn't make the set how many point page up
* Added a like facebook icon to it
* THE SCUPOINTS.COM domain is now working!
*/
//ENDPOINT AT 3:30AM
//CODED 6 Hours

//TOTAL CODED THAT DAY 11 Hours

//NEW DAY 3/19/2013
//STARTAT 1:00PM
//CHECKPOINT 3:30PM
/*
* Blitzer theme added from jquery ui
* Added the jquery ui button
* Added the jquery dialog
*/
//PROJECT COMPLETED AT 4:00
//TOTAL HOURS CODING 3!

include_once("../kint/Kint.class.php");
session_start();

    if (!($dbhandle = @mysql_connect ("localhost", "MYSQL_USERNAME_HERE!!!!!", "MYSQL_PASSWORD_HERE!!!!!")))
    {
        exit ("<body><b>Fatal Error</b>: Could not connect to MySQL host...</body>");
    }
    if (!(@mysql_select_db ("monk214_scupoints")))
    {
        exit ("<body><b>Fatal Error</b>: Could not select MySQL database...</body>"); 
    }
	
function resetPassword( $email, $password )
{
	if (!isset($password) || !isset($email))
		return "Didn't enter password or email address";
	
	$email = mysql_real_escape_string($email);
	//check to see if the info is right
	$query_string = "SELECT * FROM users WHERE Email=\"$email\"";
	$q = mysql_query($query_string);
	if ($q == False) return "No one found";
	$result = mysql_fetch_assoc($q);
	$new_password = $password;
	$new_password_hash = md5($new_password);
	$id = $result['ID'];
	$email = $result['Email'];
	//then we change the mysql password here
	$query_string = "UPDATE users SET Password=\"$new_password_hash\" WHERE ID=$id";
	$q = mysql_query($query_string) or die("Updating failed");
	//send email here confirming the password change
	sendNewPassword($email,$password);
	return "Password Updated!";
	
}



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function registerUser( $email, $password )
{
	$email = mysql_real_escape_string($email);
	$password = mysql_real_escape_string($password);
	
	if (strlen($password) < 6){ return "Password must have atleast 6 characters"; }
	
	if ( !isset($password) || !isset($email) )
		return "Didn't enter password or email address";
	
	if (checkEmail($email) == False) 
		return "Not SCU Email";
		
	$query_string = "INSERT INTO users (`ID`, `Name`, `Email`, `Password` ) VALUES (NULL, 'noname', '$email', '$password');";
	$q = mysql_query($query_string);
	
	//if the email is already in use then they login with it here
	if ($q==false) 
	{
		if (logIn($email, $password))
		{
			return "Login Success";
		}
		else
		{
			return "Wrong email or password</br><a href='forgot.php'>Forgot password?</a>";
		}
	}
	
	return "Registration Success";

}

function checkEmail ($email)
{
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	  return false;
	else
	{
	  $check = strtok($email, "@");
	  $check2 = str_replace($check, "", $email);
	  $check2 = str_replace("@", "", $check2);
	  if(strcmp("scu.edu", $check2) == 0)
		return true;
	  else
		return false;
	}
}

function logIn( $email, $password )
{
	$email = mysql_real_escape_string($email);
	$password = mysql_real_escape_string($password);
	$query_string = "SELECT count(*) as total FROM users WHERE Email=\"$email\" AND Password=\"$password\"";
	$q = mysql_query($query_string);
	$result = mysql_fetch_assoc($q);
	if ($result['total'] != 1)
		return False;
		
	return True;
}
function calculateResetCode($emailAddress)
{
	$key = $emailAddress."code";
	return md5($key);
}

function sendPasswordReset($emailAddress)
{
if (checkEmail($emailAddress) == False) 
	return "We only allow SCU Email addresses.";
	
$code = calculateResetCode($emailAddress);
$to      = $emailAddress;
$subject = 'SCUpoints verify email';
$message =<<<msg
<html>
<head>
<title>Welcome to SCUPoints</title>
</head>
<body>
<p>Your request to reset your password is one click away</p>
<br>
<h1>SCU Points</h1>
You have requested to change your password, click here to reset your password randomly.</br>If you didn't request this, just ignore this email.
<a href="www.scupoints.com/forgot.php?code=$code&email=$emailAddress">Click here to reset your password</a>
msg;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: donotreply@scupoints.com' . "\r\n" .
    'Reply-To: donotreply@scupoints.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}

function sendNewPassword($emailAddress, $password)
{
if (checkEmail($emailAddress) == False) 
	return "We only allow SCU Email addresses.";
	
$code = calculateResetCode($emailAddress);
$to      = $emailAddress;
$subject = 'SCUpoints verify email';
$message =<<<msg
<html>
<head>
<title>Welcome to SCUPoints</title>
</head>
<body>
<p>Login Info Updated</p>
<br>
<h1>SCU Points</h1>
<p>To help you remember your password we have it here : $password</p>
msg;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: donotreply@scupoints.com' . "\r\n" .
    'Reply-To: donotreply@scupoints.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}


function isVerified( $email )
{
	if (strstr($email,"@scu.edu")==false)$email .= "@scu.edu";
	$email = mysql_real_escape_string($email);
	$query_string = "SELECT isVerified FROM users WHERE Email=\"$email\"";
	$q = mysql_query($query_string) or die("Checking Verification Error");
	$result = mysql_fetch_assoc($q);
	
	if ($result['isVerified'] == 1)
		return true;
		
	return false;
}
function verifyAccount( $email )
{
	if (strstr($email,"@scu.edu")==false)
		$email .= "@scu.edu";
	$email = mysql_real_escape_string($email);
	$query_string = "UPDATE users SET isVerified=1 WHERE Email=\"$email\"";
	$q = mysql_query($query_string) or die("Updating failed");
	return "Your accont is now verified!";
}
function sendConfirmation($emailAddress)
{
if (checkEmail($emailAddress) == False) 
	return "We only allow SCU Email addresses.";
	
$code = md5($emailAddress);
$to      = $emailAddress;
$subject = 'SCUpoints verify email';
$message =<<<msg
<html>
<head>
<title>Welcome to SCUPoints</title>
</head>
<body>
<p>Only one more step left!!</p>
<br>
<h1>SCU Points</h1>
Welcome, you have signed up for scupoints</br>
<a href="www.scupoints.com/verify.php?code=$code&email=$emailAddress">Click here to complete your registration</a>
msg;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: donotreply@scupoints.com' . "\r\n" .
    'Reply-To: donotreply@scupoints.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}

//email from is the user
//email from is the buyer
//this is the function called when send email button is clicked
//TODO : check to see if they have been emailed in 24 hours
function sendEmailForPoints($emailFrom, $emailTo, $points)
{
if (checkEmail($emailFrom) == False) 
	return "We only allow SCU Email addresses.";
	
if (checkEmail($emailTo) == False) 
	return "We only allow SCU Email addresses.";
	
$to      = $emailTo;
$subject = 'SCUpoints Buyer Found!';
$message =<<<msg
<html>
<head>
<title>SCUPoints</title>
</head>
<body>
<h1>SCU Points</h1>
<p>A fellow SCU Student wants to buy : $points Points from you</p>
<br>
<p>The buyer's email address is : $emailFrom</p>
<br>
<p><strong>As a precaution, we highly recommend you meet the person at benson or at the cellar during the afternoon. Use common sense, don't agree to meet up at your dorm or their dorm.</strong> Be safe!
msg;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: donotreply@scupoints.com' . "\r\n" .
    'Reply-To: donotreply@scupoints.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

return "Email was sent!";
}
//Searching for points is done here

function searchForPoints( $points, $fbOnly =0,$minimumPPD = "1" )
{
//we want to search for the highest PPD
$points = mysql_real_escape_string(intval($points));
$query_string_where = "";
$minimumPPD = intval($minimumPPD);
if (!empty($fbOnly)) $query_string_where .= "isFBConnect=1 AND ";
if (!empty($minimumPPD)) $query_string_where .= "PPD >= $minimumPPD AND ";
//then we remove the last AND by removing the last 5 letters
if (!empty($query_string_where)) $query_string_where = substr($query_string_where,0,-5);

$query_string = "SELECT * FROM users WHERE ".$query_string_where." ORDER BY PPD DESC LIMIT 25";
$q = mysql_query($query_string);
$ans = array();
while ($ans[] = mysql_fetch_assoc($q)){}
//dd($ans);
return $ans;
}

function updateAccountWithFBInfo( $email, $fb_link, $name, $gender )
{
	$email = mysql_real_escape_string($email."@scu.edu");
	$fb_link = mysql_real_escape_string($fb_link);
	$name = mysql_real_escape_string($name);
	if ($gender == "female")
		$gender = 1;
	if ($gender == "male")
		$gender = 0;
	$gender = mysql_real_escape_string($gender);
	
	$query_string = "UPDATE users SET isFBConnect=1,fb_link=\"$fb_link\",Name=\"$name\",gender=$gender WHERE Email=\"$email\"";
	$q = mysql_query($query_string) or die("Error Facebook info update<br>".$query_string);
	return "Verified Successfully!";
}

function hasVerifiedFacebook( $email )
{
	if (strstr($email,"@scu.edu")==false)$email .= "@scu.edu";
	$email = mysql_real_escape_string($email);
	$query_string = "SELECT isFBConnect FROM users WHERE Email=\"$email\"";
	$q = mysql_query($query_string) or die("Error hasVerifiedFacebook");
	$result = mysql_fetch_assoc($q);
	if ($result['isFBConnect']==1)
		return true;
	return false;
}
function hasSetRates( $email )
{
	if (strstr($email,"@scu.edu")==false)$email .= "@scu.edu";
	$email = mysql_real_escape_string($email);
	$query_string = "SELECT Points,PPD FROM users WHERE Email=\"$email\"";
	$q = mysql_query($query_string) or die("Error hasVerifiedFacebook");
	$result = mysql_fetch_assoc($q);
	$bOkay = true;
	$bOkay = $bOkay && ($result['Points']!=0);
	$bOkay = $bOkay && ($result['PPD']!=0);

	return $bOkay;
}

function updateRates( $email, $points, $ppd )
{
	if (strstr($email,"@scu.edu")==false)
		$email .= "@scu.edu";
	$email = mysql_real_escape_string($email);
	$points = mysql_real_escape_string($points);
	$ppd = mysql_real_escape_string($ppd);
	//only allow people who have verified their email address first befor ethey can set their rates
	
	
	if (isVerified($email)==False) {
		sendConfirmation($email);
		return "First verify your email address, we sent you a new one to. '".$email."' in case you didn't get the first one!";
	}
	
	$query_string = "UPDATE users SET Points=$points,PPD=$ppd WHERE Email=\"$email\"";
	$q = mysql_query($query_string) or die("Error Facebook info update<br>".$query_string);
	
	return "Point Settings Updated Successfully!";
	return "Verified Successfully!";
}
?>