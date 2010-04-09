<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function FollowUser() {
	databaseconnect();
	$userid = sessionGet('activeUserID');
	$pageuserid = $_POST['pageuserid'];
	$now = date('Y-m-d H:i:s');
	mysql_query("INSERT INTO userfollowing(userid,targetuserid) VALUES('$userid','$pageuserid')");
	mysql_query("INSERT INTO usernotification(targetid,followerid,followdatetime) VALUES('$pageuserid','$userid','$now')");
	databasedisconnect();
}
FollowUser();
?>