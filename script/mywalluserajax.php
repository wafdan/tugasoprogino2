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

function DisplayWall() {
    databaseconnect();
	$wall_userid = $_POST['walluserid'];
	$page = $_POST['page'];
	$limit = $_POST['limit'];
    $userid = sessionGet("activeUserID");
    $userinfo = mysql_query("SELECT * FROM user WHERE userid='$wall_userid'");
    $userinfo = mysql_fetch_array($userinfo);
    $hasil = mysql_query("SELECT * FROM userwallpost WHERE userid='$wall_userid' ORDER BY timestamp DESC LIMIT $page,$limit");
	$jumlah = "SELECT * FROM userwallpost WHERE userid='$wall_userid'";
	if(mysql_num_rows($hasil) > 0) {
        //echo "<table>";
        while($data = mysql_fetch_array($hasil)) {
            $data['content'] = ScanUsername($data['content']);
            echo "<div class='friendstatus'>$userinfo[username] <label class='neutral2'>bilang</label> <label>$data[content]</label>";
            $wallcomment = mysql_query("SELECT * FROM userwallpostcomment WHERE wallpostid='$data[wallpostid]' ORDER BY timestamp");

            if(mysql_num_rows($wallcomment) > 0) {
                echo "<div class='coments'>
                                      <ul>";
				$nocomment = 0;
                while($datacomment = mysql_fetch_array($wallcomment)) {
                    $userinfocomment = mysql_query("SELECT * FROM user WHERE userid='$datacomment[userid]'");
                    $userinfocomment = mysql_fetch_array($userinfocomment);
                    $datacomment['content'] = ScanUsername($datacomment['content']);
					$nocomment++;
					if($nocomment==4)
					{
						echo "<div style=\"height:0;visibility:hidden;\" id=\"$data[wallpostid]\">";
						}
                    echo "<li><a href=\"profile.php?userid=$userinfocomment[userid]\">$userinfocomment[username] </a><label class='neutral'>bilang</label><label>$datacomment[content]</label></li>";
                }
				if($nocomment>=4)
				{
					echo "</div>";
					echo "<button type\"button\" onclick=\"ShowHideComment('$data[wallpostid]')\">Show/Hide More Comments</button>";
					}
                echo "</ul>
                                    </div>";
            }
			echo "<input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment onKeyPress=\"if(enter_pressed(event)){ PostCommentUserAjax($data[wallpostid], this.value,$wall_userid)}\">";
            echo "</div>";

        }
        //echo "</table>";
		//paginasi
		$jumlahhasil = mysql_query($jumlah);
		$jumlahhasil = mysql_num_rows($jumlahhasil);
		$jumlahhalaman = ceil($jumlahhasil/$limit);
		if($jumlahhalaman>1)
		{
			for($i=1;$i<=$jumlahhalaman;$i++)
			{
				$dest = ($i-1)*$limit;
				echo "<button type=button onclick=\"ShowMyWallUserAjax($wall_userid, $dest, $limit)\">";
				if($dest==$page)
				{
					echo "<b>$i</b>";
				}
				else{
					echo $i;
				}
				echo "</button>";
				echo " ";
			}
		}
		//
    }
    databasedisconnect();
}
DisplayWall()
?>