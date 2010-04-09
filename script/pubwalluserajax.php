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

function DisplayUserWall() {
    databaseconnect();
    $wall_userid = $_POST['walluserid'];
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    //$userid = sessionGet("activeUserID");
    //$userinfo = mysql_query("SELECT * FROM user WHERE userid='$wall_userid'");
    //$userinfo = mysql_fetch_array($userinfo);
    //
    $jumlahhasil = 0;
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
    $jumlahhalaman = ceil($jumlahhasil/$limit);
    echo "<div>";
    if($jumlahhalaman>1) {
        for($i=1;$i<=$jumlahhalaman;$i++) {
            $dest = ($i-1)*$limit;
            echo "<button type=button onclick=\"ShowPubWallUserAjax($wall_userid, $dest, $limit)\">";
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
    ////end for paginasi
    //Begin user and followers
    $resultuser = mysql_query("SELECT * FROM userfollowing WHERE targetuserid='$wall_userid' or userid='$wall_userid'");
    if(mysql_num_rows($resultuser)>0) {
        //echo "<ul>";
        while($datauser=mysql_fetch_array($resultuser)) {
            $getuser = mysql_query("SELECT * FROM user WHERE userid='$datauser[userid]'");
            $getuser = mysql_fetch_array($getuser);
            $hasil = mysql_query("SELECT * FROM userwallpost WHERE userid='$getuser[userid]' ORDER BY timestamp DESC LIMIT $page,$limit");
            $jumlah = mysql_query("SELECT * FROM userwallpost WHERE userid='$getuser[userid]'");
            if(mysql_num_rows($hasil) > 0) {
                //echo "<table>";
                while($data = mysql_fetch_array($hasil)) {
                    $data['content'] = ScanUsername($data['content']);
                    echo "<div class='friendstatus'>$getuser[username] <label class='neutral2'>bilang</label> <label>$data[content]</label>";
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
                            if($nocomment==4) {
                                echo "<div style=\"height:0;visibility:hidden;\" id=\"$data[wallpostid]\">";
                            }
                            echo "<li><a href=\"profile.php?userid=$userinfocomment[userid]\">$userinfocomment[username] </a><label class='neutral'>bilang</label><label>$datacomment[content]</label></li>";
                        }
                        if($nocomment>=4) {
                            echo "</div>";
                            echo "<button type\"button\" onclick=\"ShowHideComment('$data[wallpostid]')\">Show/Hide More Comments</button>";
                        }
                        echo "</ul>
                                    </div>";
                    }
                    echo "<input type=hidden name=pagecourseid value=$wall_userid><input type=hidden name=wallpostid value=$data[wallpostid]> <label class='neutral'>Comment</label> <input class='commentfield' type=text size=60 name=comment onKeyPress=\"if(enter_pressed(event)){ PostCommentUserAjax($data[wallpostid], this.value,$wall_userid)}\">";
                    echo "</div>";
                }
            }
        }
    }
    //END user
    //BEGIN course
    $resultcourse = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$wall_userid'");
    $resultmanager = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$wall_userid'");
    if((mysql_num_rows($resultcourse)>0)||(mysql_num_rows($resultmanager)>0)) {
        while($datacourse=mysql_fetch_array($resultcourse)) {
            $getcourse = mysql_query("SELECT * FROM courseinstance WHERE courseinstanceid='$datacourse[courseinstanceid]'");
            $getcourse = mysql_fetch_array($getcourse);
            $course = mysql_query("SELECT * FROM course WHERE courseid='$getcourse[courseid]'");
            $course = mysql_fetch_array($course);
            echo  "<li>";
            echo "<div class=\"label\">$course[coursecode]</div>";
            echo "<div class=\"info\">:$course[coursename] <a href=\"courses.php?courseid=$getcourse[courseinstanceid]\">Link<a/></div>";
            echo "</li>";
            //DisplayCoursesWall($datacourse[courseinstanceid],false);
            $courseid=$datacourse[courseinstanceid];
            $coursewallpost = mysql_query("SELECT * FROM courseinstancewallpost WHERE courseinstanceid='$courseid' ORDER BY timestamp DESC LIMIT 5");
            if(mysql_num_rows($coursewallpost)>0) {
                while($data = mysql_fetch_array($coursewallpost)) {
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
            }

        };
    }
    //paginasi
//    $q1 = "SELECT * FROM userwallpost WHERE userid='$wall_userid'";
//    $jumlahhasil = mysql_query($q1);
//    $jumlahhasil = mysql_num_rows($jumlahhasil);
//
//    $q2 = "SELECT * FROM userfollowing WHERE targetuserid='$wall_userid'";
//    $j2 = mysql_query($q2);
//    while($j3 = mysql_fetch_array($j2)) {
//        $j4 = mysql_query("SELECT * FROM userwallpost WHERE userid='$j3[userid]'");
//        $jumlahhasil += mysql_num_rows($j4);
//    }
//
//    $q3 = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$wall_userid'");
//    $q4 = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$wall_userid'");
//
//    if((mysql_num_rows($q3)>0)||(mysql_num_rows($q4)>0)) {
//        while($j5=mysql_fetch_array($q3)) {
//            $getcourse = mysql_query("SELECT * FROM courseinstance WHERE courseinstanceid='$datacourse[courseinstanceid]'");
//            $getcourse = mysql_fetch_array($getcourse);
//            $course = mysql_query("SELECT * FROM course WHERE courseid='$getcourse[courseid]'");
//            $course = mysql_fetch_array($course);
//
//            $courseid=$course[courseid];
//            $coursewallpost = mysql_query("SELECT * FROM courseinstancewallpost WHERE courseinstanceid='$courseid' ORDER BY timestamp DESC LIMIT 5");
//            $jumlahhasil += mysql_num_rows($coursewallpost);
//        }
//    }

    $jumlahhalaman = ceil($jumlahhasil/$limit);
    echo "<div>";
    if($jumlahhalaman>1) {
        for($i=1;$i<=$jumlahhalaman;$i++) {
            $dest = ($i-1)*$limit;
            echo "<button type=button onclick=\"ShowPubWallUserAjax($wall_userid, $dest, $limit)\">";
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
    //end paginasi
    //END course
    databasedisconnect();
}
DisplayUserWall();
?>
