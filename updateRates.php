<?php
include_once("mysql.scupoints.inc.php");
if (isset($_POST['emailFrom']) && isset($_POST['Points']) && isset($_POST['Ppd']))
{
	$response = updateRates($_POST['emailFrom'],intval($_POST['Points']),intval($_POST['Ppd']));
	echo $response;
}
?>