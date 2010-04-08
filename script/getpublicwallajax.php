<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
require_once("../includes/mywall.php");
sessionInit();
$uid = $_GET['userid'];

databaseconnect();
$resultcourse = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$uid'");
$resultmanager = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$uid'");

if((mysql_num_rows($resultcourse)>0)||(mysql_num_rows($resultmanager)>0)) {
    echo "<ul>";
    while($datacourse=mysql_fetch_array($resultcourse)) {
        $getcourse = mysql_query("SELECT * FROM courseinstance WHERE courseinstanceid='$datacourse[courseinstanceid]'");
        $getcourse = mysql_fetch_array($getcourse);
        $course = mysql_query("SELECT * FROM course WHERE courseid='$getcourse[courseid]'");
        $course = mysql_fetch_array($course);
        echo  "<li>";
        echo "<div class=\"label\">$course[coursecode]</div>";
        echo "<div class=\"info\">:$course[coursename] <a href=\"courses.php?courseid=$getcourse[courseinstanceid]\">Link<a/></div>";
        echo "</li>";
        DisplayCoursesWall($datacourse[courseinstanceid],false);
    };
    echo "</ul>";
}

// user follower

$resultuser = mysql_query("SELECT * FROM userfollowing WHERE userid='$uid'");

if(mysql_num_rows($resultuser)>0) {
    echo "<ul>";
    while($datauser=mysql_fetch_array($resultuser)) {
        $getuser = mysql_query("SELECT * FROM user WHERE userid='$datauser[userid]'");
        $getuser = mysql_fetch_array($getuser);
        echo  "<li>";
        echo "<div class=\"label\">$getuser[username]</div>";
        echo "<div class=\"info\">:$getuser[username] <a href=\"profile.php?userid=$getuser[userid]\">Link<a/></div>";
        echo "</li>";
        DisplayFromWall($getuser['userid']);
    };
    echo "</ul>";
}
databasedisconnect();

?>
