<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function TerimaPostWall() {
	$content = $_POST['content'];
	$userid = sessionGet('activeUserID');
	databaseconnect();
	$now = date('Y-m-d H:i:s');
	mysql_query
		("INSERT INTO userwallpost(userid,content,timestamp)
				VALUES('$userid','$content','$now')"
			);
	databasedisconnect();
}
TerimaPostWall();
?>