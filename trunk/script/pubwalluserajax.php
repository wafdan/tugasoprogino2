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

function DisplayWallorderPop($wall_userid) {
    $resulto = mysql_query("SELECT COUNT( wallpostid ) AS count, wallpostid
                          FROM userwallpostcomment
                          GROUP BY wallpostid
                          ORDER BY count DESC");
    if(mysql_num_rows($resulto) > 0) {
        echo "<label>Popular User Wallposts :</label>";
        while($data = mysql_fetch_array($resulto)) {
            $hasil = mysql_query("SELECT * FROM userwallpost WHERE wallpostid='$data[wallpostid]'");
            $hasil = mysql_fetch_array($hasil);
            //echo "<li>";
            $userinfo = mysql_query("SELECT * FROM user WHERE userid='$hasil[userid]'");
            $userinfo = mysql_fetch_array($userinfo);
            $wallcontent = ScanUsername($hasil['content']);
            echo "<div class='friendstatus'>$userinfo[username] <label class='neutral2'>bilang</label> <label>$wallcontent</label>";
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
                //echo "</li>";
            }
            echo "<form action=\"mywallhandler.php\" method=\"POST\"><input type=hidden name=frompublic value=1><input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment></form>";
            echo "</div>";
        }
    }
}

function DisplayCourseWallorderPop($wall_userid) {

    ////for paginasi
    $q1 = "SELECT * FROM userwallpost WHERE userid='$wall_userid'";
    $jumlahhasil = mysql_query($q1);
    $jumlahhasil = mysql_num_rows($jumlahhasil);

    $q2 = "SELECT * FROM userfollowing WHERE targetuserid='$wall_userid'";
    $j2 = mysql_query($q2);
    while($j3 = mysql_fetch_array($j2)) {
        $j4 = mysql_query("SELECT * FROM userwallpost WHERE userid='$j3[userid]'");
        $jumlahhasil += mysql_num_rows($j4);
    }

    $q3 = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$wall_userid'");
    $q4 = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$wall_userid'");

    if((mysql_num_rows($q3)>0)||(mysql_num_rows($q4)>0)) {
        while($j5=mysql_fetch_array($q3)) {
            $getcourse = mysql_query("SELECT * FROM courseinstance WHERE courseinstanceid='$datacourse[courseinstanceid]'");
            $getcourse = mysql_fetch_array($getcourse);
            $course = mysql_query("SELECT * FROM course WHERE courseid='$getcourse[courseid]'");
            $course = mysql_fetch_array($course);

            $courseid=$course[courseid];
            $coursewallpost = mysql_query("SELECT * FROM courseinstancewallpost WHERE courseinstanceid='$courseid' ORDER BY timestamp DESC LIMIT 5");
            $jumlahhasil += mysql_num_rows($coursewallpost);
        }
    }
    ////end for paginasi

    $resulto = mysql_query("SELECT COUNT( wallpostid ) AS count, wallpostid
                          FROM courseinstancewallpostcomment
                          GROUP BY wallpostid
                          ORDER BY count DESC");
    if(mysql_num_rows($resulto) > 0) {
        echo "<label>Popular Course Wallposts :</label>";
        while($data = mysql_fetch_array($resulto)) {
            $hasil = mysql_query("SELECT * FROM courseinstancewallpost WHERE wallpostid='$data[wallpostid]'");
            $hasil = mysql_fetch_array($hasil);
            //echo "<li>";
            $userinfo = mysql_query("SELECT * FROM user WHERE userid='$hasil[userid]'");
            $userinfo = mysql_fetch_array($userinfo);
            $wallcontent = ScanUsername($hasil['content']);
            echo "<div class='friendstatus'>$userinfo[username] <label class='neutral2'>bilang</label> <label>$wallcontent</label>";
            $wallcomment = mysql_query("SELECT * FROM courseinstancewallpostcomment WHERE wallpostid='$data[wallpostid]' ORDER BY timestamp");

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
                //echo "</li>";
            }
            echo "<form action=\"mywallhandler.php\" method=\"POST\"><input type=hidden name=frompublic value=1><input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment></form>";
            //echo "</ul>";
            echo "</div>";
        }
    }
}

function DisplayCourseWall() {
    databaseconnect();
    $resultcourse = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$uid'");
    $resultmanager = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$uid'");



    databasedisconnect();
}

function DisplayPubWall() {
    databaseconnect();
    $wall_userid = $_POST['walluserid'];
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $jumlahhasil = 0;

    $queryfollow="SELECT * FROM userfollowing WHERE targetuserid='$wall_userid'";
    $resultuserfollow = mysql_query($queryfollow);
    $querycourse="SELECT * FROM courseinstancewallpost WHERE userid='$wall_userid'";
    $resultcoursefollow = mysql_query($querycourse);
    $querywall="SELECT DISTINCT * FROM userwallpost WHERE userid='$wall_userid' ";

    if(mysql_num_rows($resultuserfollow)>0) {
        while($datauserfollow = mysql_fetch_array($resultuserfollow)) {
            $querywall=$querywall." UNION SELECT DISTINCT * FROM userwallpost WHERE userid='$datauserfollow[userid]' ";
        }
    }
    echo "<label>Terbaru : </label>";
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
    $querywall=$querywall." ORDER BY timestamp DESC LIMIT $page,$limit";

    $resultquerywall=mysql_query($querywall);
    while($dataquerywall = mysql_fetch_array($resultquerywall)) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE userid='$dataquerywall[userid]'"));

        echo "<div class='friendstatus'><medium style='float:right;' >$dataquerywall[timestamp]</medium><br/>$user[username] <label class='neutral2'>bilang</label> <label>$dataquerywall[content]</label>";
        $resultwallcomment = mysql_query("SELECT * FROM userwallpostcomment WHERE wallpostid='$dataquerywall[wallpostid]' ORDER BY timestamp ASC");
        if (mysql_num_rows($resultwallcomment)>0) {
            echo "<div class='coments'><ul>";
            $nocomment = 0;
            while($datacomment = mysql_fetch_array($resultwallcomment)) {
                $userinfocomment = mysql_query("SELECT * FROM user WHERE userid='$datacomment[userid]'");
                $userinfocomment = mysql_fetch_array($userinfocomment);
                $datacomment['content'] = ScanUsername($datacomment['content']);
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
        }
        echo "<input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$dataquerywall[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment onKeyPress=\"if(enter_pressed(event)){ PostCommentUserAjax($dataquerywall[wallpostid], this.value,$wall_userid)}\">";
        echo "</div>";
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

function DisplayCoursePubWall(){
    databaseconnect();
    $wall_userid = $_POST['walluserid'];
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $jumlahhasil = 0;
    //COURSE QUERY
    echo "<div><label>COURSE WALLPOST : </label>";
    $querycourse = "SELECT * FROM courseinstancewallpost ORDER BY timestamp DESC LIMIT $page,$limit";// WHERE userid='$wall_userid'";
    $resultcoursefollow = mysql_query($querycourse);

    //begin paginasi atas
    $jumlahhasil = mysql_num_rows((mysql_query($querycourse)));
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

    //$querycoursefollowing = "SELECT * FROM courseinstancefollowing";
    while($datacoursepost=mysql_fetch_array($resultcoursefollow)) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE userid='$datacoursepost[userid]'"));

        echo "<div class='friendstatus'><medium style='float:right;' >$datacoursepost[timestamp]</medium><br/>$user[username] <label class='neutral2'>bilang</label> <label>$datacoursepost[content]</label>";
        $resultwallcomment = mysql_query("SELECT * FROM userwallpostcomment WHERE wallpostid='$datacoursepost[wallpostid]' ORDER BY timestamp ASC");
        if (mysql_num_rows($resultwallcomment)>0) {
            echo "<div class='coments'><ul>";
            $nocomment = 0;
            while($datacomment = mysql_fetch_array($resultwallcomment)) {
                $userinfocomment = mysql_query("SELECT * FROM user WHERE userid='$datacomment[userid]'");
                $userinfocomment = mysql_fetch_array($userinfocomment);
                $datacomment['content'] = ScanUsername($datacomment['content']);
                $nocomment++;
                if($nocomment==4) {
                    echo "<div style=\"height:0;visibility:hidden;\" id=\"$datacoursepost[wallpostid]\">";
                }
                echo "<li><a href=\"profile.php?userid=$userinfocomment[userid]\">$userinfocomment[username] </a><label class='neutral'>bilang</label><label>$datacomment[content]</label></li>";
            }
            if($nocomment>=4) {
                echo "</div>";
                echo "<button type=button onclick=ShowHideComment('$datacoursepost[wallpostid]')>Show/Hide More Comments</button>";
            }
            echo "</ul></div>";
        }
        echo "<input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$datacoursepost[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment onKeyPress=\"if(enter_pressed(event)){ PostCommentUserAjax($datacoursepost[wallpostid], this.value,$wall_userid)}\">";
        echo "</div>";
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

    echo "</div>";
    //END COURSE QUERY
    databasedisconnect();
}

DisplayPubWall();
DisplayCoursePubWall();
?>
