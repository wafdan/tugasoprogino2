<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function TerimaComment() {
	databaseconnect();
	$now = date('Y-m-d H:i:s');
	$userid = sessionGet('activeUserID');
	mysql_query("INSERT INTO userwallpostcomment(wallpostid,
				userid,
				content,
				timestamp)
				VALUES(
				'$_POST[wallpostid]',
				'$userid',
				'$_POST[comment]',
				'$now'
				)");
	databasedisconnect();
}
TerimaComment();
?>