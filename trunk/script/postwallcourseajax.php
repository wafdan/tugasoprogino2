<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function TerimaPostWallCourse() {
	$content = $_POST['coursecontent'];
	$courseid = $_POST['pagecourseid'];
	$userid = sessionGet('activeUserID');
	databaseconnect();
	$now = date('Y-m-d H:i:s');
	mysql_query
		("INSERT INTO courseinstancewallpost(userid,content,timestamp,courseinstanceid)
				VALUES('$userid','$content','$now','$courseid')"
			);
	databasedisconnect();
}
TerimaPostWallCourse();
?>