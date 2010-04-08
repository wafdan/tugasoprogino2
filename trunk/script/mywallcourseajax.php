<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();

function ScanUsername($str) {
	preg_match_all('/@[.a-z0-9_]{5,}/', $str, $matches);
	foreach($matches[0] as $match) {
		$username = substr($match, 1, strlen($match));
		
		$sql = "SELECT * FROM `user` WHERE `username` = '$username'";
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) > 0) {
			$str = str_replace($match, '<a href="profile.php">'.$username.'</a>', $str);
		}
	}
	
	return $str;
}

function DisplayCoursesWall() {
	databaseconnect();
	$courseid = $_POST['courseid'];
	$page = $_POST['page'];
	$limit = $_POST['limit'];
	$userid = sessionGet("activeUserID");
	$hasil = mysql_query("SELECT * FROM courseinstancewallpost WHERE courseinstanceid='$courseid' ORDER BY timestamp DESC LIMIT 5");
	if(mysql_num_rows($hasil) > 0) {
		//echo "<table>";
		while($data = mysql_fetch_array($hasil)) {
			$userinfo = mysql_query("SELECT * FROM user WHERE userid='$data[userid]'");
			$userinfo = mysql_fetch_array($userinfo);
			echo "<div class='friendstatus'>$userinfo[username] <label class='neutral2'>bilang</label> <label>$data[content]</label>";
			$wallcomment = mysql_query("SELECT * FROM courseinstancewallpostcomment WHERE wallpostid='$data[wallpostid]' ORDER BY timestamp");
			if(mysql_num_rows($wallcomment) > 0) {
				echo "<div class='coments'>
						<ul>";
				while($datacomment = mysql_fetch_array($wallcomment)) {
					$userinfocomment = mysql_query("SELECT * FROM user WHERE userid='$datacomment[userid]'");
					$userinfocomment = mysql_fetch_array($userinfocomment);
					echo "<li><a href=\"profile.php?userid=$userinfocomment[userid]\">$userinfocomment[username] </a><label class='neutral'>bilang</label><label>$datacomment[content]</label></li>";
				}
				echo "</ul>
						</div>";
			}
			echo "<input type=hidden name=pagecourseid value=$courseid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=coursecomment onKeyPress=\"if(enter_pressed(event)){ PostCommentCourseAjax($data[wallpostid], this.value,$wall_userid)}\">";
			echo "</div>";
			
		}
		//echo "</table>";
	}
	databasedisconnect();
}
DisplayCoursesWall();
?>