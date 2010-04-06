<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function ChangeAvatar() {
	databaseconnect();
	$tempname = $_POST['filenamehash'];
	$dummy_userid = sessionGet("activeUserID");
	mysql_query("UPDATE user SET avatar='$tempname' WHERE userid='$dummy_userid'");
	databasedisconnect();
}

ChangeAvatar()
?>