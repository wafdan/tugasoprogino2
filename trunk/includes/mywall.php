<?php
require_once("databaseconnection.php");
require_once("session.php");
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

function DisplayWall($wall_userid) {
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

function RedirectToProfile() {
    if($pageuserid) {
        header('Location: profile.php?userid=$pageuserid');
    }
    else {
        header('Location: profile.php');
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

function mainWall() {
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

?>