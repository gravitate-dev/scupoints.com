<?php
//this clears session data
session_start();
if (isset($_SESSION['email']))
{
	$_SESSION['email'] = "";
}
session_destroy();
echo<<<redir
<script>
window.location="main.php";
</script>
redir;
?>