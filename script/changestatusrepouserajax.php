<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function ChangeAttributeStatus(){
	databaseconnect();
	$statusupdate = $_POST['statusupdate'];
	mysql_query("UPDATE userrepository SET status='$statusupdate' WHERE repositoryid='$_POST[repositoryid]'");
	databasedisconnect();
}

ChangeAttributeStatus()
?>