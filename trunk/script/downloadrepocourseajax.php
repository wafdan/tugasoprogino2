<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function ChangeAttributeStatus(){
	databaseconnect();
	$count = $_POST['counter']+1;
	mysql_query("UPDATE courseinstancerepository SET counter='$count' WHERE repositoryid='$_POST[repositoryid]'");
	databasedisconnect();
}

ChangeAttributeStatus()
?>