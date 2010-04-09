<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
require_once("../includes/mywall.php");
require_once("pubwalluserajax.php");
sessionInit();
$uid = $_GET['userid'];

databaseconnect();
DisplayWallorderPop($uid);
DisplayCourseWallorderPop($uid);
databasedisconnect();

?>
