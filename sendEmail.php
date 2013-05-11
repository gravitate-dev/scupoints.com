<?php
//this file sends an email to the person in the send email button
include_once("mysql.scupoints.inc.php");

if (isset($_POST['points']) && isset($_POST['emailFrom']) && isset($_POST['emailTo']))
{
	$response = sendEmailForPoints($_POST['emailFrom'],$_POST['emailTo'],$_POST['points']);
	echo $response;
}
?>