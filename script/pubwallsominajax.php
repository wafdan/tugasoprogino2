<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function DisplayPopulerPubWall() {
    databaseconnect();
    $wall_userid = $_POST['walluserid'];
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $jumlahhasil = 0;
    
    $queryfollow="SELECT * FROM userfollowing WHERE targetuserid='$wall_userid'";
    $resultuserfollow = mysql_query($queryfollow);
    $querycourse="SELECT * FROM courseinstancefollowing WHERE userid='$wall_userid'";
    $resultcoursefollow = mysql_query($querycourse);
    $querywall="SELECT DISTINCT * FROM userwallpost WHERE userid='$wall_userid' ";

    if(mysql_num_rows($resultuserfollow)>0) {
        while($datauserfollow = mysql_fetch_array($resultuserfollow)) {
            $querywall=$querywall." UNION SELECT DISTINCT * FROM userwallpost WHERE userid='$datauserfollow[userid]' ";
        }
    }
    //begin paginasi atas
    $jumlahhasil = mysql_num_rows((mysql_query($querywall)));
    $jumlahhalaman = ceil($jumlahhasil/$limit);
    echo "<div>";
    if($jumlahhalaman>1) {
        for($i=1;$i<=$jumlahhalaman;$i++) {
            $dest = ($i-1)*$limit;
            echo "<button type=button onclick=\"ShowPubWallAjax($wall_userid, $dest, $limit)\">";
            if($dest==$page) {
                echo "<b>$i</b>";
            }
            else {
                echo $i;
            }
            echo "</button>";
        }
    }
    echo "</div>";
    //end paginasi atas
    $querywall=$querywall." ORDER BY timestamp DESC";
    
    $resultquerywall=mysql_query($querywall);
	$start =0;
	$startlimit =0;
	while($start<$page)
	{
		$dataquerywall = mysql_fetch_array($resultquerywall);
		$start++;
		}
	while(($dataquerywall = mysql_fetch_array($resultquerywall))&&($startlimit<$limit)) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE userid='$dataquerywall[userid]'"));

        $resultwallcomment = mysql_query("SELECT * FROM userwallpostcomment WHERE wallpostid='$dataquerywall[wallpostid]' ORDER BY timestamp ASC");
        if (mysql_num_rows($resultwallcomment)>=3) {
			$limit++;
			echo "<div class='friendstatus'><medium style='float:right;' >$dataquerywall[timestamp]</medium><br/>$user[username] <label class='neutral2'>bilang</label> <label>$dataquerywall[content]</label>";
			echo "<div class='coments'><ul>";
            $nocomment = 0;
            while($datacomment = mysql_fetch_array($resultwallcomment)) {
                $userinfocomment = mysql_query("SELECT * FROM user WHERE userid='$datacomment[userid]'");
                $userinfocomment = mysql_fetch_array($userinfocomment);
                $nocomment++;
                if($nocomment==4) {
                    echo "<div style=\"height:0;visibility:hidden;\" id=\"$dataquerywall[wallpostid]\">";
                }
                echo "<li><a href=\"profile.php?userid=$userinfocomment[userid]\">$userinfocomment[username] </a><label class='neutral'>bilang</label><label>$datacomment[content]</label></li>";
            }
            if($nocomment>=4) {
                echo "</div>";
                echo "<button type=button onclick=ShowHideComment('$dataquerywall[wallpostid]')>Show/Hide More Comments</button>";
            }
            echo "</ul></div>";
			echo "<input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$dataquerywall[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment onKeyPress=\"if(enter_pressed(event)){ PostCommentUserAjax($dataquerywall[wallpostid], this.value,$wall_userid)}\">";
			echo "</div>";
		}
    }

    //begin paginasi bawah
    echo "<div>";
    if($jumlahhalaman>1) {
        for($i=1;$i<=$jumlahhalaman;$i++) {
            $dest = ($i-1)*$limit;
            echo "<button type=button onclick=\"ShowPubWallAjax($wall_userid, $dest, $limit)\">";
            if($dest==$page) {
                echo "<b>$i</b>";
            }
            else {
                echo $i;
            }
            echo "</button>";
        }
    }
    echo "</div>";
    //end paginasi bawah

    databasedisconnect();
}

DisplayPopulerPubWall();
?>
