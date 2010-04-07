<?php

require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
$t = $_GET['targetid'];

databaseconnect();
//$result = mysql_query("SELECT * FROM usernotification WHERE targetid='$t'");
$result = mysql_query("SELECT * FROM userfollowing WHERE targetuserid='$t' ORDER BY followid DESC");
//$result2= mysql_query("SELECT * FROM user WHERE userid='$t'");
echo "<ul>";
while ($row = mysql_fetch_array($result)){
    $result2= mysql_query("SELECT * FROM user WHERE userid='{$row['userid']}'");
    $uname = mysql_fetch_array($result2);
    echo "<li>";
    echo "Anda telah difollow oleh <a href='profile.php?userid={$row['userid']}'>{$uname['username']}</a> ";//pada {$row['followdatetime']}";
    echo "</li>";
}
echo "</ul>";

databasedisconnect();
?>
