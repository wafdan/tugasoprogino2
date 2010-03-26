<?php
require_once("databaseconnection.php");
require_once("session.php");
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

function DisplayWall($wall_userid) {
    databaseconnect();
    $userid = sessionGet("activeUserID");
    $userinfo = mysql_query("SELECT * FROM user WHERE userid='$wall_userid'");
    $userinfo = mysql_fetch_array($userinfo);
    $hasil = mysql_query("SELECT * FROM userwallpost WHERE userid='$wall_userid' ORDER BY timestamp DESC LIMIT 5");
    if(mysql_num_rows($hasil) > 0) {
        //echo "<table>";
        while($data = mysql_fetch_array($hasil)) {
			$data['content'] = ScanUsername($data['content']);
            echo "<div class='friendstatus'>$userinfo[username] <label class='neutral2'>bilang</label> <label>$data[content]</label>";
            $wallcomment = mysql_query("SELECT * FROM userwallpostcomment WHERE wallpostid='$data[wallpostid]' ORDER BY timestamp");

            if(mysql_num_rows($wallcomment) > 0) {
                echo "<div class='coments'>
                                      <ul>";
                while($datacomment = mysql_fetch_array($wallcomment)) {
                    $userinfocomment = mysql_query("SELECT * FROM user WHERE userid='$datacomment[userid]'");
                    $userinfocomment = mysql_fetch_array($userinfocomment);
					$datacomment['content'] = ScanUsername($datacomment['content']);
                    echo "<li><a href=\"profile.php?userid=$userinfocomment[userid]\">$userinfocomment[username] </a><label class='neutral'>bilang</label><label>$datacomment[content]</label></li>";
                }
                echo "</ul>
                                    </div>";
            }
			echo "<form action=\"mywallhandler.php\" method=\"POST\"><input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment></form>";
            echo "</div>";

        }
        //echo "</table>";
    }
    databasedisconnect();
}

function DisplayFromWall($wall_userid) {
	$userid = sessionGet("activeUserID");
	$userinfo = mysql_query("SELECT * FROM user WHERE userid='$wall_userid'");
	$userinfo = mysql_fetch_array($userinfo);
	$hasil = mysql_query("SELECT * FROM userwallpost WHERE userid='$wall_userid' ORDER BY timestamp DESC LIMIT 5");
	if(mysql_num_rows($hasil) > 0) {
		//echo "<table>";
		while($data = mysql_fetch_array($hasil)) {
			$data['content'] = ScanUsername($data['content']);
			echo "<div class='friendstatus'>$userinfo[username] <label class='neutral2'>bilang</label> <label>$data[content]</label>";
			$wallcomment = mysql_query("SELECT * FROM userwallpostcomment WHERE wallpostid='$data[wallpostid]' ORDER BY timestamp");
			
			if(mysql_num_rows($wallcomment) > 0) {
				echo "<div class='coments'>
						<ul>";
				while($datacomment = mysql_fetch_array($wallcomment)) {
					$userinfocomment = mysql_query("SELECT * FROM user WHERE userid='$datacomment[userid]'");
					$userinfocomment = mysql_fetch_array($userinfocomment);
					$datacomment['content'] = ScanUsername($datacomment['content']);
					echo "<li><a href=\"profile.php?userid=$userinfocomment[userid]\">$userinfocomment[username] </a><label class='neutral'>bilang</label><label>$datacomment[content]</label></li>";
				}
				echo "</ul>
						</div>";
			}
			echo "<form action=\"mywallhandler.php\" method=\"POST\"><input type=hidden name=frompublic value=1><input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment></form>";
			echo "</div>";
			
		}
		//echo "</table>";
	}
}

/*
function DisplayCoursesWall($courseid)
{
	databaseconnect();
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
			echo "<form action=\"mywallhandler.php\" method=\"POST\"><input type=hidden name=pagecourseid value=$courseid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=coursecomment></form>";
			echo "</div>";
			
		}
		//echo "</table>";
	}
	databasedisconnect();
	}*/
	
function DisplayCoursesWall($courseid,$nodatabase)
{
	if($nodatabase==true){
		databaseconnect();
	}
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
			echo "<form action=\"mywallhandler.php\" method=\"POST\"><input type=hidden name=frompublic value=1><input type=hidden name=pagecourseid value=$courseid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=coursecomment></form>";
			echo "</div>";
			
		}
		//echo "</table>";
	}
	if($nodatabase==true){
		databasedisconnect();
	}
}

function RedirectToProfile() {
	if($_POST['fromwall']){
		header("Location: publicwall.php");
		}else{
	$pageuserid = $_POST['pageuserid'];
    if($pageuserid) {
        header("Location: profile.php?userid=$pageuserid");
    }
		else {
			header('Location: profile.php');
	}
	}
}

function  RedirectToCourseWall(){
		if($_POST['fromwall']){
		header("Location: publicwall.php");
	}else{
		$pagecourseid = $_POST['pagecourseid'];
		if($pagecourseid) {
			header("Location: courses.php?courseid=$pagecourseid");
		}
		else {
			header('Location: courses.php');
		}
	}
}

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

function FollowUser()
{
	databaseconnect();
	$userid = sessionGet('activeUserID');
	$pageuserid = $_POST['pageuserid'];
	mysql_query("INSERT INTO userfollowing(userid,targetuserid) VALUES('$userid','$pageuserid')");
	databasedisconnect();
	}

function DisplayPublicWall($wall_userid)
{
	databaseconnect();
	$userid = sessionGet("activeUserID");
	$userinfo = mysql_query("SELECT * FROM user WHERE userid='$wall_userid'");
	$userinfo = mysql_fetch_array($userinfo);
	$hasil = mysql_query("SELECT * FROM userwallpost WHERE userid='$wall_userid' ORDER BY timestamp DESC LIMIT 5");
	if(mysql_num_rows($hasil) > 0) {
		//echo "<table>";
		while($data = mysql_fetch_array($hasil)) {
			echo "<div class='friendstatus'>$userinfo[username] <label class='neutral2'>bilang</label> <label>$data[content]</label>";
			$wallcomment = mysql_query("SELECT * FROM userwallpostcomment WHERE wallpostid='$data[wallpostid]' ORDER BY timestamp");
			
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
			echo "<form action=\"mywallhandler.php\" method=\"POST\"><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment></form>";
			echo "</div>";
			
		}
		//echo "</table>";
	}
	databasedisconnect();
	}

function TerimaCommentCourse() {
	databaseconnect();
	$now = date('Y-m-d H:i:s');
	$userid = sessionGet('activeUserID');
	mysql_query("INSERT INTO courseinstancewallpostcomment(wallpostid,
				userid,
				content,
				timestamp)
				VALUES(
				'$_POST[wallpostid]',
				'$userid',
				'$_POST[coursecomment]',
				'$now'
				)");
	databasedisconnect();
}

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

function FollowCourse()
{
	databaseconnect();
	$userid = sessionGet('activeUserID');
	$pagecourseid = $_POST['pagecourseid'];
	mysql_query("INSERT INTO courseinstancefollowing(userid,courseinstanceid) VALUES('$userid','$pagecourseid')");
	databasedisconnect();
}

function mainWall() {
	if($_POST['coursecomment'])
	{
		RedirectToCourseWall();
		TerimaCommentCourse();
		}
	elseif($_POST['coursecontent'])
		{
		RedirectToCourseWall();
		TerimaPostWallCourse();
			}
	elseif($_POST['followcourse'])
	{
		RedirectToCourseWall();
		FollowCourse();
	}
	else{
		RedirectToProfile();
		if($_POST['content']) {
			TerimaPostWall();
		}elseif($_POST['comment']) {
			TerimaComment();
		}elseif($_POST['followuser'])
		{
			FollowUser();
		}
	}
}

?>