<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
require_once("../includes/mywall.php");
sessionInit();
$uid = $_GET['userid'];

echo "<h2><a href=javascript:nothingHappens();>Follower</a></h2>";
echo "<ul>";
databaseconnect();
$friendresult = mysql_query("SELECT * FROM userfollowing WHERE targetuserid='$uid'");
while($datafriend=mysql_fetch_array($friendresult)) {
    $userfriend = mysql_query("SELECT * FROM user WHERE userid='$datafriend[userid]'");
    $userfriend = mysql_fetch_array($userfriend );
    echo "<li> <a class=\"friendName\" href=\"profile.php?userid=$datafriend[userid]\">$userfriend[fullname]</a>";
};
echo "</ul>";
?>
