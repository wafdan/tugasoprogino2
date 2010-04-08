<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
require_once("../includes/mywall.php");
sessionInit();
$uid = $_GET['userid'];

databaseconnect();
$result = mysql_query("SELECT * FROM user WHERE userid='$uid'");
$data = mysql_fetch_array($result);
databasedisconnect();

echo "<h2><a href=profile.php?userid={$uid}>$data[fullname]</a></h2>";
$avatar = $data['avatar'];
echo "<img id=\"primary-photo\" src=\"repositoryfiles/$avatar\" alt=\"Picture not Found\" />";

?>
