<?php
include_once("mysql.scupoints.inc.php");
//check to see if they verified first
$skip = False;
if (isset($_SESSION['verified']))
{
	$email = $_SESSION['email'];
	echo<<<email
	Please check your email address
email;
	$skip = True;
	die();
}
if (isset($_GET['code']) && isset($_GET['email']))
{
	$oode = $_GET['code'];
	$email = $_GET['email'];
	if ($code != md5($email))
		die("Verification email is wrong");
		
	verifyAccount($_GET['email']);
}
?>
<h1>Your account is now verified</h1>