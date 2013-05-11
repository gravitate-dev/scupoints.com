<?php
include_once("mysql.scupoints.inc.php");
if (isset($_POST['points']) && isset($_POST['fbVerify']))
{
	$number = intval($_POST['points']);
	$fbVerify = 0;
	if ($_POST['fbVerify'] == "true") { $fbVerify = 1; }
	echo json_encode(searchForPoints($number, $fbVerify));
}
?>